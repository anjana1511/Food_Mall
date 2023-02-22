<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required'],
            'address' => ['required'],
            'gender' => ['required'],
            'dob' => ['required'],
            'join_date' => ['required'],
            'job_type' => ['required'],
            'city' => ['required'],
            'age' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // dd($data);
        $imageName=$data['image'];
        
        if($imageName!==null)
        {


            // get the extension
            $extension = $imageName->getClientOriginalExtension();
            // create a new file name
            $new_name = date( 'Y-m-d' ) . '-' . Str::random( 10 ) . '.' . $extension;
            // move file to public/images/new and use $new_name
            $imageName->move(public_path('image/users'), $new_name);
        }

        return User::create([
            'username' => $data['username'],
            'image' => $new_name,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'role' => '2',
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'address' => $data['address'],
            'gender' => $data['gender'],
            'dob' => $data['dob'],
            'join_date' => $data['join_date'],
            'job_type' => $data['job_type'],
            'city' => $data['city'],
            'age' => $data['age'],
            

            ]);
    }
}
