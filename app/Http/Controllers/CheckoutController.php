<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderCourier;
use App\Models\User;
use App\Models\PaymentSettings;
use Illuminate\Support\Facades\Auth;


class CheckoutController extends Controller
{
    private $_api_context;
    /**
     * Create a new controller instance.
     * 
     * @return void
     */

    // Constructing function for middleware
    public function __construct()
    {
        $this->middleware('auth');
        
    }
    
    // Checkout index view function with $checkout 
    // variable fetching some datas from orderCourier table from DB
    public function index()
    {
        if( OrderCourier::where('user_id', Auth::id())->exists()){
            $checkout= OrderCourier::where('user_id', Auth::id())->latest()->first();
            $payment = PaymentSettings::all()->first();
            return view('user.checkout.index', compact('checkout', 'payment'));
        }
        else
        {
            return redirect('/');
        }
    }

    // Place order call function with requests
    public function placeorder(Request $request)
    {   
        // This validate the required input while using 
        // the place order button from the checkout page
        $this->validate($request,[
            'name' => 'required|string',
            'email' => 'required|string',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postcode' => 'required',
            'country' => 'required|string',
            'phone' => 'required|string',
            'gender' => 'required|string',
        ]);

        // Update the orderCourier table after the input has been submited and validated
        if(OrderCourier::where('user_id', Auth::id()))
        {
            $order = OrderCourier::latest()->first();
            $order->payment_mode = $request->input('payment_mode');
            $order->payment_id = $request->input('payment_id');
            $order->order_note = $request->message;
            $order->tracking_no = 'Gcourier'.rand(1111,9999);
            $order->payment_id = 'PAYID'.rand(111111,999999);
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

        if($request->input('payment_mode')== 'RazorPay')
        {
            return response()->json(['success'=> "Order placed successfully"]);
        }
        
        // Back to Home page with sweet alert
        return redirect()->back()->with('success', "Order Placed Successfully");
    }

 
}