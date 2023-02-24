<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //

        /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $users = User::select('*')->paginate(10);
        return view('admin.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.user.create');
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
        $request -> validate([
            'username' => 'required',
            'image' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
        ]);
        
        $user = new User();
        $user -> username = $request -> username;
        
        if($request->hasfile('image'))
        {

            $file = $request->file('image');
            // dd($file);
            $extension = $file->getClientOriginalExtension();
            $new_name = date( 'Y-m-d' ) . '-' . Str::random( 10 ) . '.' . $extension;
            $file ->move(public_path('image/users'), $new_name);
            $user->image = $new_name;
        }
        else{
            // dd("o");
              $user->image = '';
            }
            $user -> first_name = $request -> first_name;
            $user -> last_name = $request -> last_name;
            $user -> role = $request -> role;
            $user -> email = $request -> email;
            $user -> password= Hash::make($request->password);
            $user -> phone = $request -> phone;
            $user -> address = $request -> address;
            $user -> gender = $request -> gender;
            $user -> dob = $request -> dob;
            $user -> join_date = $request -> join_date;
            $user -> job_type = $request -> job_type;
            $user -> city = $request -> city;
            $user -> age = $request -> age;
            $user -> save();
            // return redirect()->route('user');
            return redirect()->route('user')      
            ->with('success','Product created successfully.');

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
         $user = User::find($id);
        return view('admin.user.edit',compact('user'));
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

        $request -> validate([
            'username' => 'required',
            'image' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
        ]);
        
        $user = User::find($id);
        $user -> username = $request -> username;
        
        if($request->hasfile('image'))
        {

            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $new_name = date( 'Y-m-d' ) . '-' . Str::random( 10 ) . '.' . $extension;
            $file ->move(public_path('image/users'), $new_name);
            $user->image = $new_name;
        }
        else{
              $user->image = '';
            }
            $user -> first_name = $request -> fname;
            $user -> last_name = $request -> lname;
            $user -> role = $request -> role;
            $user -> email = $request -> email;
            $user -> phone = $request -> phone;
            $user -> address = $request -> address;
            $user -> gender = $request -> gender;
            $user -> dob = $request -> dob;
            $user -> join_date = $request -> join_date;
            $user -> job_type = $request -> job_type;
            $user -> city = $request -> city;
            $user -> age = $request -> age;
            $user -> save();
            return redirect()->route('user');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $inputArr=$request->all();
        $user = User::where('id','=',$inputArr['id']);
        $user -> delete();
        return response()->json($inputArr['id']);
    }

    public function search(Request $request){
        $users =User::where('username', 'LIKE',"%{$request->search}%")->paginate();
        return view('admin.user.index',compact('users'));
    }

}
