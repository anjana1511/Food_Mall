<?php

namespace App\Http\Controllers;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Food;
use App\Models\Menu_Item;
use App\Models\Customer;
use Illuminate\Http\Request;
use DB;
class CashierController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $all_menu=Menu::join('menu_item','menu_item.menu_id','=','menu.menu_id')
        ->select('menu.menu_id','menu.menu_name')
        ->get();
        $all_cat=Category::join('foods','foods.cat_id','=','categories.cat_id')
        ->select('categories.cat_id','categories.cat_name')
        ->get();
        $menu=$all_menu->unique('menu_id');
        $all_category=$all_cat->unique('cat_id');
        // dd($all_category);
      

        return view('cashier.index',compact('menu','all_category'));
    }

    public function add_to_cart(Request $request)
    {
        // dd($request->all());
        if(isset($request->menu_id) && $request->menu_id != '0')
        {
            if(!isset($request->quantity))
            {
               $quantity='1';
            }else{
               $quantity=$request->quantity;
            }

            $menu_price_details=Menu::select('menu_price')
            ->where('menu_id','=',$request->menu_id)
            ->first();
            $menu_price=$menu_price_details->menu_price;
            $Qprice=$menu_price*$quantity;
            
            $menu_exist=DB::table('orderdetails')
            ->where('order_id','=','0')
            ->where('menu_id','=',$request->menu_id)
            ->first();
             if($menu_exist == null)
               {
            $data=[
                'food_id' => '0',
                'menu_id'=>$request->menu_id,
                'amount' =>$Qprice,
                'quantity'=>$quantity,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                ];
                $store=DB::table('orderdetails')->insert($data);
              }
              else
              {
                $exqty=$menu_exist->quantity + $quantity;
                $exprice=$exqty *$menu_price;
                

                $store=DB::table('orderdetails')
                ->where('order_id','=','0')
                ->where('menu_id','=',$request->menu_id)
                ->update(['quantity'=> $exqty,'amount'=>$exprice]);
              }

        }
        else{
            if(!isset($request->qty))
             {
                $qty='1';
             }else{
                $qty=$request->qty;
             }

             $food_exist=DB::table('orderdetails')
             ->where('order_id','=','0')
             ->where('food_id','=',$request->edit_id)
             ->first();
             if($food_exist == null)
             {
             $Qprice=$request->amount * $qty;
                $data=[
                'food_id' => $request->edit_id,
                'amount' =>$Qprice,
                'quantity'=>$qty,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                ];

                $store=DB::table('orderdetails')->insert($data);
            }
            else
            {
                $exqty=$food_exist->quantity + $qty;
                $exprice=$exqty * $request->amount;

                $store=DB::table('orderdetails')
                ->where('order_id','=','0')
                ->where('food_id','=',$request->edit_id)
                ->update(['quantity'=> $exqty,'amount'=>$exprice]);
            }
                
            }
            return redirect()->back()->with('success', 'Item Added successfully.',json_encode(array(
                "statusCode"=>200
            )));

        //      return json_encode(array(
        //       "statusCode"=>200
        //   ));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function move_to_cart()
    {
        //
                
        $summ=DB::table('orderdetails')
        ->select('*',DB::raw('SUM(quantity) as tqty,SUM(amount) as tamount'))
        ->where('order_id','=','0')
        ->get();
        
        $order_detail=DB::table('orderdetails')
              ->leftjoin('foods','foods.food_id','=','orderdetails.food_id')
              ->leftjoin('menu','menu.menu_id','=','orderdetails.menu_id')
              ->where('orderdetails.order_id','=','0')
              ->get();

              $cust = Customer::select('*')->get();
        return view('cashier.cart',compact('order_detail','summ','cust'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function order_confim(Request $request)
    {
        //
        // dd($request->all());
        $order_data=[
               'customer_id' => $request->cust_id,
               'total_amount' => $request->tamount,
               'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ];
        $order=DB::table('order')->insert($order_data);

        if($order)
        {
            // dd('yes');
            // select MAX(BillId) as BillId from tblBillMaster
            $order_detail=DB::table('order')
            ->select('order_id',DB::raw('MAX(order_id) as order_id'))
            ->first();

            $order_id=$order_detail->order_id;

            $up=DB::table('orderdetails')
            ->where('order_id','=','0')
            ->update(['order_id' => $order_id]);
            return redirect()->route('home')->with('success', 'Menu Item Updated successfully.');
        }
        else
        {
            return redirect()->back()->with('error', 'Something was Wrong.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $orders=DB::table('order')
                 ->join('customers',function($join){
                    $join->on('customers.cust_id','=','order.customer_id');
                 })->leftJoin('orderdetails',function($join){
                    $join->on('orderdetails.order_id','=','order.order_id');
                 })
                 ->groupBy('order.order_id')
                 ->get();
                //  dd($orders);
                 return view('cashier.order.all_orders',compact('orders'));
    }
    public function get_by_id(Request $request)
    {
        $inputArr=$request->all();

        $orders['orderdata']=DB::table('order')
        ->join('customers',function($join){
           $join->on('customers.cust_id','=','order.customer_id');
        })->leftJoin('orderdetails',function($join){
           $join->on('orderdetails.order_id','=','order.order_id');     
        })->where('order.order_id','=',$inputArr['edit_id'])
        ->first();
        
        return response()->json($orders);
        
    }
    public function invoice_details_show($id)
    {
        // $inputArr=$request->all();


        $orders=DB::table('order')
        ->select('*',DB::raw('orderdetails.quantity*foods.price as tamount'))
        ->leftJoin('orderdetails',function($join){
           $join->on('orderdetails.order_id','=','order.order_id');     
        })->leftJoin('foods',function($join){
            $join->on('foods.food_id','=','orderdetails.food_id');     
         })
         ->leftJoin('menu',function($join){
            $join->on('menu.menu_id','=','orderdetails.menu_id');     
         })
         ->where('order.order_id','=',$id)
        ->get();


        $summ=DB::table('order')
        ->select('*',DB::raw('SUM(quantity) as tqty,total_amount+30 as final_amount'))
        ->leftjoin('orderdetails','orderdetails.order_id','=','order.order_id')
        ->where('order.order_id','=',$id)
        ->get();

        $cust = Customer::select('*')
        ->leftjoin('order','order.customer_id','=','customers.cust_id')
        ->where('order.order_id','=',$id)
        ->first();

        return view('cashier.order.invoice',compact('orders','summ','cust'));

    }

    public function changestatus(Request $request)
    {
        $cat=DB::table('order')
        ->where('order_id', $request->get('edit_id'))
         ->update(['status' => $request -> estatus,]);

        if($cat){
        return redirect()->route('orders')->with('success', 'Order Updated successfully.');
        }
        else {
        return redirect()->route('orders')->with('error', 'Failed! Order not Updated');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
