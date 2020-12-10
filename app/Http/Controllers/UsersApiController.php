<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
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
            return ["Respone" => Response::HTTP_CREATED,
                "Result" => "Data has been saved",
                "Data" => $result];
        } else{
            return ["Respone" => Response::HTTP_FORBIDDEN,
                "Result" => "Failed to Save"];
        }

    }
}
