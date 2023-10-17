<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderCourier;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Redirect;
use Razorpay\Api\Api;
use Session;
use Exception;

class RazorpayController extends Controller
{
    public function store(Request $request) 
    {
        
        $name= $request->input('name');
        $email= $request->input('email');
        $phone= $request->input('phone');
        $gender= $request->input('gender');
        $address= $request->input('address');
        $city= $request->input('city');
        $state= $request->input('state');
        $country= $request->input('country');
        $postcode= $request->input('postcode');
        $currency= $request->input('currency');

        $price= $request->input('price');

        return response()->json([
            'name'=> $name, 
            'email'=> $email,
            'phone'=> $phone,
            'gender'=> $gender,
            'address'=> $address,
            'city'=> $city,
            'state'=> $state,
            'country'=> $country,
            'postcode' => $postcode,
            'price' => $price,
            'currency' => $currency,
        ]);

    }

    public function razorCallBack(Request $request)
    {
        // Update the orderCourier table after the input has been submited and validated
        if(OrderCourier::where('user_id', Auth::id()))
        {
            $order = OrderCourier::latest()->first();
            $order->payment_mode = $request->input('payment_mode');
            $order->payment_id = $request->input('payment_id');
            $order->order_note = $request->message;
            $order->tracking_no = 'Gcourier'.rand(1111,9999);
            $order->status = 'New';
            $order->update();
        }

        // Update the User table after the input has been submited and validated
        if(Auth::user()->address==NULL)
        {
            $user = User::where('id', Auth::id())->first();
            $user->gender = $request->gender;
            $user->country = $request->input('country');
            $user->address = $request->input('address');
            $user->city = $request->input('city');
            $user->state = $request->input('state');
            $user->pincode = $request->input('postcode');
            $user->phone = $request->input('phone');
            $user->update();
        }

        return response()->json(['success'=> "Order placed successfully"]);
        
    }



}
