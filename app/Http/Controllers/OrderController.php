<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Recipient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use \PDF;
class OrderController extends Controller
{

  public function placeOrder(Request $request){
      //ini_set('max_execution_time', 300);
      $validator = Validator::make($request->all(),
          [
              'userId' => 'required',
              'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
          ]);

      if ($validator->fails()) {
          return response()->json(['error'=>$validator->errors()], 401);
      }

      $recipient = new Recipient();
      $recipient->recipients_name = $request->recipientsName;
      $recipient->message = $request->message;
      $recipientResult = $recipient->save();
      $recipientResult = $recipient->toArray();

      $address = new Address();
      $address->postal_address = $request->postal_address;
      $address->shipping_address = $request->shipping_address;
      $addressResult = $address->save();
      $addressResult = $address->toArray();

      $payment = new Payment();
      $payment->payment_mathod = $request->payment_method;
      $payment->discount = $request->discount;
      $payment->status = $request->status;
      $paymentResult = $payment->save();
      $paymentResult = $payment->toArray();

      //store file into images folder
      $image = $request->file('photo');
      $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
      $extension = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
      $fullFileName = $fileName."-".time().".".$image->getClientOriginalExtension();

      $destinationPath = public_path('/images');
      $image->move($destinationPath, $fullFileName);

      $order = new Order();
      $order->user_id = $request->userId;
      $order->payment_id = $paymentResult['id'];
      $order->address_id = $addressResult['id'];
      $order->recipient_id = $recipientResult['id'];
      $order->price = $request->price;
      $order->img = $fullFileName;
      $orderResult = $order->save();

      if ($orderResult) {
          $this->createPDF($fullFileName,$recipient->message,$address->shipping_address);
          return response()->json(['success'=> " Order Created"], 200);
      }
      return response()->json(['error'=> "Failed to process order"], 401);

  }

  public function userOrders(Request $request){
      $validator = Validator::make($request->all(),
          [
              'userId' => 'required',
          ]);

      if ($validator->fails()) {
          return response()->json(['error'=>$validator->errors()], 401);
      }

      $userId = $request->userId;

      $userOrders = DB::table('orders')
          ->join('payments', 'orders.payment_id', '=', 'payments.id')
          ->join('address', 'orders.address_id', '=', 'address.id')
          ->join('recipients', 'orders.recipient_id', '=', 'recipients.id')
          ->where('orders.user_id', $userId)->get();

      if ($userOrders) {
          return response()->json(
              [
                  'success'=> "User Orders",
                  'data' => $userOrders,
              ], 200);
      }
      return response()->json(['error'=> "Failed to fetch user orders"], 401);
  }

  public function showPaidOrders(){
      $page_title = 'Paid Orders List';
      $page_description = 'All Paid Orders';
      $paidOrders = DB::table('orders')
          ->select('users.first_name','users.last_name','orders.*','payments.*','address.*','recipients.*')
          ->join('payments', 'orders.payment_id', '=', 'payments.id')
          ->join('address', 'orders.address_id', '=', 'address.id')
          ->join('recipients', 'orders.recipient_id', '=', 'recipients.id')
          ->join('users', 'orders.user_id', '=', 'users.id')
          ->where('payments.status', 1)
          ->orderBy('orders.id', 'desc')->get();

      return view('pages.paidOrdersList', compact('page_title', 'page_description','paidOrders'));
  }
    public function showPendingPaymentOrders(){
        $page_title = 'Un-Paid Orders List';
        $page_description = 'Un Paid Orders';
        $unpaidOrders = DB::table('orders')
            ->select('users.first_name','users.last_name','orders.*','payments.*','address.*','recipients.*')
            ->join('payments', 'orders.payment_id', '=', 'payments.id')
            ->join('address', 'orders.address_id', '=', 'address.id')
            ->join('recipients', 'orders.recipient_id', '=', 'recipients.id')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->where('payments.status', 0)
            ->orderBy('orders.id', 'desc')->get();

        return view('pages.UnpaidOrdersList', compact('page_title', 'page_description','unpaidOrders'));
    }

    public function createPDF($img,$msg,$address) {

        $data["title"] = "Order and has been received successfully";

        $data['img'] = $img;
        $data['msg']  = $msg;
        $data['address'] = $address;

        $pdf = PDF::loadView('email.myTestMail',$data);
        Mail::send('email.myTestMail', $data, function($message)use($data, $pdf) {
            $message->from('info@sorloza.com','The Sender');
            $message->to($data["email"], $data["email"])
                ->subject($data["title"])
                ->attachData($pdf->output(), "demo.pdf");
        });
    }
}
