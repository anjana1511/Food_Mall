<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;

class CategoryController extends Controller
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
        $category = Category::select('*')->paginate(5);
        return view('admin.category.index',compact('category'));
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
        $category = new Category();
        $category -> cat_name = $request -> cat_name;
        $category -> cat_description = $request -> cat_description;
        $category -> status = $request -> status;

        if($request->hasfile('image'))
        {

            $file = $request->file('image');
            // dd($file);
            $extension = $file->getClientOriginalExtension();
            $new_name = date( 'Y-m-d' ) . '-' . Str::random( 10 ) . '.' . $extension;
            $file ->move(public_path('image/category'), $new_name);
            $category->image = $new_name;
        }
        else{
            // dd("o");
              $category->image = '';
             }
            
             $cat=$category -> save();
             if($cat){
            return redirect()->route('category')->with('success', 'Category created successfully.');
            }
            else{
                return redirect()->route('category')->with('error', 'Category Not Created.');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
        $inputArr=$request->all();
        $category['catdata']=Category::where('cat_id','=',$inputArr['edit_id'])->first();
        return response()->json($category);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        if($request->hasfile('eimage'))
        {

            $file = $request->file('eimage');
            $extension = $file->getClientOriginalExtension();
            $new_name = date( 'Y-m-d' ) . '-' . Str::random( 10 ) . '.' . $extension;
            $file ->move(public_path('image/category'), $new_name);
            $pic = $new_name;
        }
        else{
          
              $pic = '';
             }
             $updatedetails=[
                'cat_name' => $request -> ecat_name,
                'cat_description' => $request -> ecat_description,
                'status' => $request -> estatus,
                'image'  => $pic,
           ];

                $cat=DB::table('categories')
                        ->where('cat_id', $request->get('edit_id'))
                         ->update($updatedetails);
          
            if($cat){
             return redirect()->route('category')->with('success', 'Category Updated successfully.');
            }
            else {
                return redirect()->route('category')->with('error', 'Failed! Category not Updated');
            }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $inputArr=$request->all();
        $model = Category::where('cat_id','=',$inputArr['id']);   
        $model->delete();

        return response()->json($inputArr['id']);

    }

    public function search(Request $request){
        
        $category =Category::where('cat_name', 'LIKE',"%{$request->search}%")->paginate(5);
        
        return view('admin.category.index',compact('category'));
    }
}
