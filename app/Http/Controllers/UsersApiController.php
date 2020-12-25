<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Mail\NewMail;
use App\Models\User;
use App\Models\userContacts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
//use Barryvdh\DomPDF\PDF as PDF;
use \PDF;

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

            $userData = [
                'name' => $request->first_name.' '.$request->last_name,
                'info' => 'Laravel Developer'
            ];
            Mail::to($request->email)->send(new NewMail($userData));

            return [
                "Response" => Response::HTTP_CREATED,
                "Result" => "Data has been saved",
                "Data" => $user->toArray()
            ];
        } else{
            return [
                "Response" => Response::HTTP_FORBIDDEN,
                "Result" => "Failed to Save"
            ];
        }
    }

    public function userContactStore(Request $request){
        $validator = Validator::make($request->all(),
            [
                'user_id' => 'required',
                'name' => 'required',
            ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $userContact = new userContacts();
        $userContact->user_id = $request->user_id;
        $userContact->alias = $request->alias;
        $userContact->name = $request->name;
        $userContact->surname = $request->surname;
        $userContact->address = $request->address;
        $userContact->population = $request->population;
        $userContact->province = $request->province;
        $userContact->postalCode = $request->postalCode;

        $userContactResult = $userContact->save();

        if ($userContactResult) {
            return response()->json(
                ['success'=> "Recipient Added"], 200);
        }
        return response()->json(['error'=> "Failed to add recipient"], 401);

    }

    public function allUserContacts(Request $request){
        $validator = Validator::make($request->all(),
            [
                'user_id' => 'required',
            ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $user_id = $request->user_id;

        $recipientUsers = DB::table('user_contacts')->where('user_id', $user_id)->get();

        if ($recipientUsers) {
            return response()->json(
                [
                    'success'=> "Recipients Fetched",
                    'data' => $recipientUsers,
                ], 200);
        }
        return response()->json(['error'=> "Failed to fetch recipients"], 401);

    }

    public function getUserNotifications(Request $request){
        $validator = Validator::make($request->all(),
            [
                'user_id' => 'required',
            ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $user_id = $request->user_id;

        $userNotifications = DB::table('user_notifications')
            ->join('notification','user_notifications.notification_id','=','notification.id')
            ->where('user_id', $user_id)
            ->where('type', '=','notification')->get();

        if ($userNotifications) {
            return response()->json(
                [
                    'success'=> "Notifications Fetched Successfully",
                    'data' => $userNotifications,
                ], 200);
        }
        return response()->json(['error'=> "Failed to fetch notifications"], 401);

    }

    public function getPostCardPrice(){
        $currentPostCardPrice = DB::table('postcardprice')->orderByDesc('id')->first();;

        if ($currentPostCardPrice) {
            return response()->json(
                [
                    'success'=> "Post Card Price Fetched Successfully",
                    'data' => $currentPostCardPrice,
                ], 200);
        }
        return response()->json(['error'=> "Failed to fetch Post Card Price"], 401);
    }

}
