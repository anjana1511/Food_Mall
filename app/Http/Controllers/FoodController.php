<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;

class FoodController extends Controller
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
        $food = Food::select('*')->paginate(5);
        $category=Category::select('cat_name','cat_id')->get();
        // dd($category);
        return view('admin.food.index',compact('food','category'));

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
        // dd($request->all());
        $food = new Food();
        $food -> food_name = $request -> food_name;
        $food -> cat_id = $request -> cat_name;
        $food->price=$request ->price;
        $food -> food_description = $request -> food_description;
        $food -> status = $request -> status;

        if($request->hasfile('image'))
        {

            $file = $request->file('image');
            // dd($file);
            $extension = $file->getClientOriginalExtension();
            $new_name = date( 'Y-m-d' ) . '-' . Str::random( 10 ) . '.' . $extension;
            $file ->move(public_path('image/Food'), $new_name);
            $food->image = $new_name;
        }
        else{
            // dd("o");
              $food->image = '';
             }
            
             $foods=$food -> save();
             if($foods){
            return redirect()->route('food')->with('success', 'Food created successfully.');
            }
            else{
                return redirect()->route('food')->with('error', 'Food Not Created.');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $cfdata=Food::where("cat_id","=",$id)->pluck("food_name","food_id");
        return json_encode($cfdata);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
        $inputArr=$request->all();
        $food['fooddata']=Food::where('food_id','=',$inputArr['edit_id'])->first();
        return response()->json($food);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        if($request->hasfile('eimage'))
        {

            $file = $request->file('eimage');
            $extension = $file->getClientOriginalExtension();
            $new_name = date( 'Y-m-d' ) . '-' . Str::random( 10 ) . '.' . $extension;
            $file ->move(public_path('image/Food'), $new_name);
            $pic = $new_name;
        }
        else{
          
              $pic = '';
             }
             $updatedetails=[
                'food_name' => $request ->efood_name,
                'cat_id' => $request -> ecat_name,
                'food_description' => $request -> efood_description,
                'status' => $request -> estatus,
                'image'  => $pic,
           ];

                $cat=DB::table('foods')
                        ->where('food_id', $request->get('edit_id'))
                         ->update($updatedetails);
          
            if($cat){
             return redirect()->route('food')->with('success', 'Food Updated successfully.');
            }
            else {
                return redirect()->route('food')->with('error', 'Failed! Food not Updated');
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $inputArr=$request->all();
        $model = Food::where('food_id','=',$inputArr['id']);   
        $model->delete();

        return response()->json($inputArr['id']);

    }

    public function search(Request $request){
        
        $food =Food::where('food_name', 'LIKE',"%{$request->search}%")->paginate(5);
        $category=Category::select('cat_name','cat_id')->get();

        
        return view('admin.food.index',compact('food','category'));
    }
}
