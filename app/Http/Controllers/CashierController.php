<?php

namespace App\Http\Controllers;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Food;
use App\Models\Menu_Item;
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
             // dd($request->menu_id);
            $menu_Item=Menu::join('menu_item','menu_item.menu_id','=','menu.menu_id')
            ->join('foods','foods.food_id','=','menu_item.food_id')
            ->where('menu_item.menu_id','=',$request->menu_id)
            ->select('menu_item.menu_id','menu_item.food_id','menu_item.cat_id','foods.price')
            ->get();
              
            if(!isset($request->quantity))
            {
               $quantity='1';
            }else{
               $quantity=$request->quantity;
            }

            $len=count($menu_Item);
            // dd($len);
            for($i=0; $i<$len; $i++)
            {
                $data=[
                    'food_id'=>$menu_Item[$i]['food_id'],
                    'menu_id'=>$request->menu_id,
                    'amount' =>$menu_Item[$i]['price'],
                    'quantity'=>$quantity,
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
             ];
                $store=DB::table('orderdetails')->insert($data);
             
            }
        }
        else{
            if(!isset($request->qty))
             {
                $qty='1';
             }else{
                $qty=$request->qty;
             }
                $data=[
                'food_id' => $request->edit_id,
                'amount' =>$request->amount,
                'quantity'=>$qty,
                'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                ];

                $store=DB::table('orderdetails')->insert($data);
                
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
