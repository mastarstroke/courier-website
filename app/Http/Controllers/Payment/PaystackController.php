<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Models\OrderCourier;
use App\Models\User;
use App\Models\PaymentSettings;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Paystack;

class PaystackController extends Controller
{

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway(Request $request)
    {
        // This validate the required input while using the Paystack button from the checkout page
        $this->validate($request,[
            'name' => 'required|string',
            'email' => 'required|string',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postcode' => 'required|numeric',
            'country' => 'required|string',
            'phone' => 'required|string',
            'gender' => 'required|string',

        ]);
        
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
            $user->save();
        }

        // Update the orderCouriers table after the input has been submited and validated
        if(OrderCourier::where('user_id', Auth::id())->where('tracking_no', NULL))
        {
            $order = OrderCourier::latest()->first();
            $order->order_note = $request->message;
            $order->save();
        }

        $currency = PaymentSettings::all()->first();

        try{  
            $data = array(
                "amount" => $request->price * 100,
                "reference" => $request->reference,
                "email" => $request->email,
                "currency" => $currency->currency,
                "orderID" => 'PayStackID'.rand(11111,99999),
            );
            
            return Paystack::getAuthorizationUrl($data)->redirectNow();
        }catch(\Exception $e) {
            return Redirect::back()->with(['error'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
        }        
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        // dd($paymentDetails);

        // Update records after successfull payment
        if(OrderCourier::where('user_id', Auth::id()))
        {
            $order = OrderCourier::latest()->first();
            $order->payment_mode = 'PayStack/' . $paymentDetails['data']['channel'];
            $order->payment_id = 'PayID-' . $paymentDetails['data']['id'];
            $order->tracking_no = 'Gcourier'.rand(1111,9999);
            $order->save();
        }
        // Back to Home page with sweet alert displaying the payment ID
        return Redirect::to('checkout-index')
        ->with('success', 'ORDER PLACED SUCCESSFULLY! ..Your payment ID is : '. $order->payment_id );  
    }
}
