<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    public function authorize(){
        return true;
    }

    public function rules(){
        return [
          'first_name' => [
              'required',
          ],
            'last_name' => [
                'required',
            ],
            'email' => [
                'required',
            ],
            'password' => [
                'required',
            ],
        ];

    }
}

//'contact' => [
//    'required',
//],
//            'postal_address' => [
//    'required',
//],
//            'permenant_address' => [
//    'required',
//],
//            'postal_code' => [
//    'required',
//],
//            'city' => [
//    'required',
//],
//            'country' => [
//    'required',
//],
//            'state' => [
//    'required',
//],
//            'delievery_type' => [
//    'required',
//],
//            'packaging_type' => [
//    'required',
//],
//            'preferred_delivery_window' => [
//    'required',
//],
