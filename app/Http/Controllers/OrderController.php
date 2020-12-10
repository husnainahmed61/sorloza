<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Order;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
class OrderController extends Controller
{
    //

  public function placeOrder(Request $request){
     
     //payment method
  	//discount
  	//id

  	//return 'ok';

  	// echo "<pre>";
  	// print_r($request->all());
    $payment = array(
    	'payment_mathod'=>$request->input('payment_method'),
    	'discount'=>$request->input('discount'),'status'=>0,
    	'created_at'=>time(),
    	'updated_at'=>time());
  //  $P_id = Payment::create($payment)->id;
    // echo $id;die;
   $address = array(
                'shipping_address' =>$request->input('shipping_address'),
                'postal_address'   =>$request->input('postal_address'),
                'created_at'       => time(),
                'updated_at'       => time()     
              );
    $A_id    = Address::create($address)->id;

   // echo $A_id;

    $U_id = $request->user('api');

    
 echo csrf_token() ;die;


  }

}
