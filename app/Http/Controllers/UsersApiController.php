<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use App\Http\Resources\User as UserResource;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UsersApiController extends Controller
{
    public function store(RegisterUserRequest $request)
    {
        $user = new User();
        $user->role_id = 2;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->contact = $request->contact;
        $user->postal_address = $request->postal_address;
        $user->permenant_address = $request->permenant_address;
        $user->postal_code = $request->postal_code;
        $user->city = $request->city;
        $user->country = $request->country;
        $user->state = $request->state;
        $user->delievery_type = $request->delievery_type;
        $user->packaging_type = $request->packaging_type;
        $user->preferred_delivery_window = $request->preferred_delivery_window;
        $user->email = $request->email;
        $user->password =Hash::make($request->password);

        $result = $user->save();

        if ($result){
            return ["Result" => "Data has been saved"];
        } else{
            return ["Result" => "Failed to Save"];
        }

//
//        $data = $request->all();
//
//        $data['password'] = Hash::make($data['password']);
//        $data['role_id'] = 2;
//
//        print_r($data);
//
//        $user = User::create($data);
//        var_dump($user);
//        exit();
//        return (new UserResource($user))
//            ->response()
//            ->setStatusCode(Response::HTTP_CREATED);

        //return $this->respondWithToken($token);

        //$data['role_id'] = 2;
//
//        return User::create([
//            'role_id'=>$data['role_id'],
//            'first_name' => $data['first_name'],
//            'last_name' => $data['last_name'],
//            'contact' => $data['contact'],
//            'postal_address' => $data['postal_address'],
//            'permenant_address' => $data['permenant_address'],
//            'postal_code' => $data['postal_code'],
//            'city' => $data['city'],
//            'country' => $data['country'],
//            'state' => $data['state'],
//            'delievery_type' => $data['delievery_type'],
//            'packaging_type' => $data['packaging_type'],
//            'preferred_delivery_window' => $data['preferred_delivery_window'],
//            'email' => $data['email'],
//            'password' => Hash::make($data['password']),
//
//        ]);
    }
}
