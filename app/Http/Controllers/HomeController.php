<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use App\Models\UserNotifications;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use function GuzzleHttp\Promise\all;
use function PHPUnit\Framework\assertDirectoryDoesNotExist;

class HomeController extends Controller
{
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
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function addNotification(){
        $users = DB::table('users')->where('role_id', 2)->orderBy('id', 'desc')->get();
        $notifications = DB::table('notification')->orderBy('id', 'desc')->get();

        return view('pages/addNotifications', compact('users','notifications'));
    }

    public function storeNotification(Request $request){
        $validator = Validator::make($request->all(),
            [
                'notification' => 'required',
            ]);

        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }

        $notification = new Notifications();
        $notification->body = $request->notification;
        $result = $notification->save();
        $insertId = $notification->toArray();
        if ($result){
            $notificationId = $insertId['id'];
            $users = $request->users;
            foreach ($users as $user){
                $userNotifications = new UserNotifications();
                $userNotifications->notification_id = $notificationId;
                $userNotifications->user_id = $user;
                $userNotificationsResult = $userNotifications->save();
            }
            return redirect()->back()->with('success', 'Notification Sent Successfully');
        }
    }

}
