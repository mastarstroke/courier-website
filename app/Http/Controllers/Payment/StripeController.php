<?php

namespace App\Http\Controllers\Payment;

// Used Models, Exception, Stripe, Request and Auth
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderCourier;
use App\Models\User;
use App\Models\PaymentSettings;
use Exception;
use Session;
use Stripe;

class StripeController extends Controller
{
    // Card payment call function with request
    public function card_payment(Request $request)
    {
        // This validate the required input while using the stripe button from the checkout page
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


        // Stripe integration setups and validations
        try {
            $stripe = new \Stripe\StripeClient(
                env('STRIPE_SECRET')
        );
            $resp = $stripe->tokens->create([
                'card' => [
                    'name' => $request->card_name,
                    'number' => $request->card_no,
                    'exp_month' => $request->exp_month,
                    'exp_year' => $request->exp_year,
                    'cvc' => $request->cvc,
                ],
            ]);

            $currency = PaymentSettings::all()->first();

            // set api key here
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            $stripe->charges->create([
                'amount' => $request->price * 100,
                'currency' => '$currency->currency',
                'source' => $resp->id,
                'description' => $order->order_note,
            ]);

            // Update records to ordercourier table after successfull payment
            if(OrderCourier::where('user_id', Auth::id())->where('tracking_no', NULL))
            {
                $order = OrderCourier::latest()->first();
                $order->payment_mode = 'Card/Stripe';
                $order->payment_id = 'StripePayID'.rand(111111,999999);
                $order->tracking_no = 'Gcourier'.rand(1111,9999);
                $order->save();
            }

            // Back to Home page with sweet alert displaying the payment ID
            return redirect('/')->with('success', 'ORDER PLACED SUCCESSFULLY! ..your payment ID is : PAYID'. $order->payment_id);
        
            // Catch the exceptions if there is any error.
        } catch(\Stripe\Error\Card $e) {
            Session::flash('fail-message', $e->get_message());
        }

    }

}
