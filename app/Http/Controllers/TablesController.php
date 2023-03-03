<?php

namespace App\Http\Controllers;

use App\Models\Tables;
use Illuminate\Http\Request;
use DB;

class TablesController extends Controller
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
        $data = Tables::select('*')->paginate(5);
        return view('admin.tables.index',compact('data'));

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
        $tables = new Tables();
        $tables -> table_name = $request -> table_name;
        $tables->size=$request ->size;
        $tables -> status = $request -> status;

        $data=$tables -> save();
        if($data){
       return redirect()->route('tables')->with('success', 'Table created successfully.');
       }
       else{
           return redirect()->route('tables')->with('error', 'Table Not Created.');
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tables  $tables
     * @return \Illuminate\Http\Response
     */
    public function show(Tables $tables)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tables  $tables
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //
        $inputArr=$request->all();
        $table['tabledata']=Tables::where('table_id','=',$inputArr['edit_id'])->first();
        return response()->json($table);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tables  $tables
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tables $tables)
    {
        //
        $updatedetails=[
            'table_name' => $request ->etable_name,
            'size' => $request -> esize,
            'status' => $request -> estatus,
             ];

            $cat=DB::table('tables')
                    ->where('table_id', $request->get('edit_id'))
                     ->update($updatedetails);
      
        if($cat){
         return redirect()->route('tables')->with('success', 'Table Updated successfully.');
        }
        else {
            return redirect()->route('tables')->with('error', 'Failed! Table not Updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tables  $tables
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $inputArr=$request->all();
        $model = Tables::where('table_id','=',$inputArr['id']);   
        $model->delete();

        return response()->json($inputArr['id']);
    }
    public function search(Request $request){

        $data =Tables::where('table_name', 'LIKE',"%{$request->search}%")->paginate(5);
               
        return view('admin.tables.index',compact('data'));
    }
}
