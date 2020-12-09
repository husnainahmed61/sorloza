<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
        // echo "<pre>";
        // print_r($data);die;
        $data['role_id'] = 2;
        return Validator::make($data, [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'contact' => ['required', 'string'],
            'postal_address' => ['required', 'string'],
            'permenant_address' => ['required', 'string'],
            'postal_code' => ['required', 'numeric'],
            'city' => ['required', 'string'],
            'country' => ['required', 'string'],
            'state' => ['required', 'string'],
            'delievery_type' => ['required', 'string'],
            'packaging_type' => ['required', 'string'],
            'preferred_delivery_window' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string'],
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
        $data['role_id']=1;
        // echo "<pre>";
        // print_r($data);die;
        
        return User::create([
            'role_id'=>$data['role_id'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'contact' => $data['contact'],
            'postal_address' => $data['postal_address'],
            'permenant_address' => $data['permenant_address'],
            'postal_code' => $data['postal_code'],
            'city' => $data['city'],
            'country' => $data['country'],
            'state' => $data['state'],
            'delievery_type' => $data['delievery_type'],
            'packaging_type' => $data['packaging_type'],
            'preferred_delivery_window' => $data['preferred_delivery_window'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
          
        ]);
    }

public function registerForm(){
    //echo "ok";die;
    return view('pages/signup');
}

}
