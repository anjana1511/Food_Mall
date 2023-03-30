<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Category;
use App\Models\Food;
use App\Models\Menu_Item;
use Illuminate\Http\Request;
use DB;

class MenuController extends Controller
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
        //
        $category=Category::where('status','=','Available')->get();
        $food=Food::where('status','=','Available')->get();
        $data=Menu::select('*')->paginate(5);
        return view('admin.menu.index',compact('data','category','food'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
        //Add menu Item Page
        $category=Category::where('status','=','Available')->get();
        $food=Food::where('status','=','Available')->get();
        $data=Menu::where('menu_id','=',$id)->first();
        $items=DB::table('menu_item')
                    ->join('menu','menu.menu_id','=','menu_item.menu_id')
                    ->join('foods','foods.food_id','=','menu_item.food_id')
                    ->join('categories','categories.cat_id','=','menu_item.cat_id')
                    ->where('menu_item.menu_id','=',$id)
                    ->paginate(5);
        
        return view('admin.menu.item',compact('items','data','category','food'));
    }
    public function store_item(Request $request)
    {

         $inputArr=$request->all();
         $data=[

                'menu_id' => $inputArr['menu_name'],
                'cat_id'  => $inputArr['cat_name'],
                'food_id' => $inputArr['food_name'],

         ];
         $savedata=Menu_Item::create($data);
          if($savedata)
         {

            $Menu=DB::table('menu_item')
            ->select('menu_id','menu_item.food_id','foods.price',DB::raw('MAX(`item_id`) as item_id'))
            ->join('foods','foods.food_id','=','menu_item.food_id')
            ->where('menu_item.item_id','=',DB::raw('(select max(`item_id`) from menu_item)'))
            ->first();

            $menu_id=$Menu->menu_id;
            $price=$Menu->price;
            
            $menu_price_details=Menu::select('menu_price')
                       ->where('menu_id','=',$menu_id)
                       ->first();
             $menu_price=$menu_price_details->menu_price;
                       
             $addprice=$price+$menu_price;

            $up=DB::table('menu')
            ->where('menu_id','=',$menu_id)
            ->update(['menu_price' => $addprice]);
            
            return redirect()->back()->with('success','Item Add Successfully');
         }
         else
         {
            return redirect()->back()->with('error','Failed Item Not Add');
         }
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
        $inputArr=$request->all();
        
        $data=[
            'menu_name' => $inputArr['menu_name'],
            'status' => $inputArr['status'],
             ];
        
             $dat=Menu::create($data);

        if($dat)
        {
            return redirect()->route('menu')->with('success', 'Menu created successfully.');
            }
            else{
                return redirect()->route('menu')->with('error', 'Menu Not Created.');
            }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $cfdata = DB::table('menu_item')
        ->join('menu','menu.menu_id','=','menu_item.menu_id')
        ->join('foods','foods.food_id','=','menu_item.food_id')
        ->join('categories','categories.cat_id','=','menu_item.cat_id')
        ->select('*')
        ->where('menu_item.menu_id','=',$id)
        ->get();

        return json_encode($cfdata);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
        $inputArr=$request->all();

        if($inputArr['data_act'] == 'menu_up'){

            //Menu Update
        $menu['menudata']=Menu::where('menu_id','=',$inputArr['edit_id'])->first();
        return response()->json($menu);
        }
        else 
        {
            //Menu Item Update
            $menu['menudata']=DB::table('menu_item')
            ->join('menu','menu.menu_id','=','menu_item.menu_id')
            ->join('foods','foods.food_id','=','menu_item.food_id')
            ->join('categories','categories.cat_id','=','menu_item.cat_id')
            ->where('menu_item.item_id','=',$inputArr['edit_id'])
            ->first();
            return response()->json($menu);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $inputArr=$request->all();
       
        switch ($request->input('action')) {
            case 'menu':
                        $updatedata=[
                            'menu_name' => $inputArr['emenu_name'],
                            'status' => $inputArr['estatus'],
                        ];
                        $up=Menu::where('menu_id','=',$inputArr['edit_id'])->update($updatedata);

                        if($up){
                            return redirect()->route('menu')->with('success', 'Menu Updated successfully.');
                        }
                        else {
                            return redirect()->route('menu')->with('error', 'Failed! Menu not Updated');
                        }
                break;
            case 'menu_item'  :

                    $updatedata=[
                            'menu_id' => $inputArr['emenu_id'],
                            'cat_id'  => $inputArr['cat_name'],
                            'food_id' => $inputArr['food_name'],
                            'status'  => $inputArr['estatus'],
                    ];
                        $up=Menu_Item::where('item_id','=',$inputArr['edit_id'])->update($updatedata);
                               if($up){
                                    return redirect()->back()->with('success', 'Menu Item Updated successfully.');
                                }
                                
                                else{
                                    return redirect()->back()->with('error', 'Menu Not Updated.');
                                }
                break;  
            }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $inputArr=$request->all();
        $model=Menu::where('menu_id','=',$inputArr['id'])->delete();
        return response()->json($inputArr['id']);
    }
    public function destroy_item(Request $request)
    {
        $inputArr=$request->all();
        $model=Menu_Item::where('item_id','=',$inputArr['id'])->delete();
        return response()->json($inputArr['id']);
    }

    public function search(Request $request){

     $data =Menu::where('menu_name', 'LIKE',"%{$request->search}%")->paginate(5);
       
        return view('admin.menu.index',compact('data'));
    
    }
}
