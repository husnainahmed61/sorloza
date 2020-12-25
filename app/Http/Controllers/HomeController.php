<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use App\Models\Order;
use App\Models\PostCardPrice;
use App\Models\User;
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
            return redirect()->back()->with('error', $validator->errors());
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

    public function ordersChart(Request $request){
        $page_title = 'Orders';
        $page_description = 'Orders Received Last Week';

        if (isset($request->dateFrom) && isset($request->dateTo)){
            $validator = Validator::make($request->all(),
                [
                    'dateFrom' => 'required',
                    'dateTo' => 'required',
                ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors());
            }

            $orders = Order::orderBy('created_at', 'desc')
                ->whereBetween('created_at', [$request->dateFrom, $request->dateTo])
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"))
                ->get(array(
                    DB::raw('Date(created_at) as date'),
                    DB::raw('COUNT(*) as "orders"')
                ));

            return view('charts.orders', compact('page_title', 'page_description','orders'));
        }


        $lastWeek = date('Y-m-d H:i.s', strtotime('-1 week'));
        $orders = Order::orderBy('created_at', 'desc')->where('created_at', '>=', $lastWeek)
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"))
            ->get(array(
                DB::raw('Date(created_at) as date'),
                DB::raw('COUNT(*) as "orders"')
            ));

        return view('charts.orders', compact('page_title', 'page_description','orders'));
    }

    public function usersChart(Request $request){
        $page_title = 'Users';
        $page_description = 'Users Registered Last Week';

        if (isset($request->dateFrom) && isset($request->dateTo)){
            $validator = Validator::make($request->all(),
                [
                    'dateFrom' => 'required',
                    'dateTo' => 'required',
                ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors());
            }

            $users = User::orderBy('created_at', 'desc')
                ->whereBetween('created_at', [$request->dateFrom, $request->dateTo])
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"))
                ->get(array(
                    DB::raw('Date(created_at) as date'),
                    DB::raw('COUNT(*) as "users"')
                ));

            return view('charts.users_chart', compact('page_title', 'page_description','users'));
        }

        $lastWeek = date('Y-m-d H:i.s', strtotime('-1 week'));
        $users = User::orderBy('created_at', 'desc')->where('created_at', '>=', $lastWeek)
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d')"))
            ->get(array(
                DB::raw('Date(created_at) as date'),
                DB::raw('COUNT(*) as "users"')
            ));

        return view('charts.users_chart', compact('page_title', 'page_description','users'));
    }

    public function viewCard(){
        //echo 'ok';
        return view('cards/cardTest');
    }

    public function postCardPriceForm(){
        return view('pages/addPostCardPrice');
    }

    public function submitPostCardPrice(Request $request){
        $validator = Validator::make($request->all(),
            [
                'postCardPrice' => 'required',
            ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors());
        }

        $postCardPrice = new PostCardPrice();
        $postCardPrice->price = $request->postCardPrice;
        $result = $postCardPrice->save();
        if ($result){
            return redirect()->back()->with('success', 'Price Saved Successfully');
        }
        return redirect()->back()->with('error', 'Failed To Save Price');

    }



}
