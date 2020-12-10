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
        $data = $request->all();

        $data['password'] = Hash::make($data['password']);
        $data['role_id'] = 2;

        print_r($data);

        $user = User::create($data);
        var_dump($user);
        exit();
        return (new UserResource($user))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

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
