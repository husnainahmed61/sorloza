<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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


    public function show()
    {
        $page_title = 'Users List';
        $page_description = 'All available users';
        $users = DB::table('users')->where('role_id', 2)->orderBy('id', 'desc')->get();

        return view('pages.usersList', compact('page_title', 'page_description','users'));
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

    public function createNewUser(){
        $page_title = 'Create New User';
        $page_description = 'Create New User From Admin Panel';

        return view('pages.newUser', compact('page_title', 'page_description'));
    }

    public function storeNewUser(Request $request){
        $validator = Validator::make($request->all(),
            [
                'email' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
            ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors());
        }

        $password = str_random(8);
        $user = new User();
        $user->role_id = 2;
        $user->email = $request->email;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->contact = $request->contact;
        $user->postal_address = $request->postal_address;
        $user->permenant_address = $request->permenant_address;
        $user->postal_code = $request->postal_code;
        $user->city = $request->city;
        $user->country = $request->country;
        $user->state = $request->state;
        $user->password =Hash::make($password);

        $result = $user->save();

        if ($result){
            $to_name = $request->first_name.' '.$request->last_name;
            $to_email = $request->email;
            $body = "email :". $request->email . " Password : ". $password;
            $data = array('name' => 'Sorloza', 'body' => $body);

            Mail::send('email.registerationByAdmin', $data, function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                    ->subject('You are Registered By Admin');
                $message->from('test@sorloza.com','Sorloza');
            });
            return redirect()->back()->with('success', "User registered Successfully");
        }
        return redirect()->back()->with('error', "Failed To Register");
    }
}
