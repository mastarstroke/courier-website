<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderCourier;
use App\Models\User;
use App\Models\PaymentSettings;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;                        
use PayPal\Api\Details;                        
use PayPal\Api\Item; 

use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use URL;
use Notification;
use Exception;

class PaypalController extends Controller
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
        
        // paypal configuration with api key included
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['client_secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    // Paypal call function with requests
    public function paypal(Request $request)
    {
            // This validate the required input while using the paypal button from the checkout page
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

        // Update orderCourier table after the input has been submited and validated
        if(OrderCourier::where('user_id', Auth::id()))
        {
            $order = OrderCourier::latest()->first();
            $order->order_note = $request->message;
            $order->save();
        }

        $currency = PaymentSettings::all()->first();
        
        // Creating new data as users into paypal
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();

        // set the currency here
        $item_1->setName('item 1')
            ->setCurrency($currency->currency)
            ->setQuantity(1)
            ->setPrice($request->get('price'));

            // storing new item
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        // storing the currency created
        $amount = new Amount();
        $amount->setCurrency($currency->currency)
            ->setTotal($request->get('price'));

            // new transaction added with amount and description
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your Transaction Description');

            // redirect urls added here
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::to('status'))
            ->setCancelUrl(URL::to('status'));

            // new payment is added in sale with urls, transaction and urls
        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

            //The api context is been created here while it also debug and catch exception
        try {
            $payment->create($this->_api_context);
        } catch (\Paypal\Exception\PPConnectionException $ex) {
            
            if (\Config::get('app.debug')){

                \Session::put('error', 'Connection timeout');
                return Redirect::to('checkout-index');

            } else {
                \Session::put('error', 'some error occur, sorry for inconvenient');
                return Redirect::to('checkout-index');
            }
        }

        // Approve the payment urls and redirect to paypal for payment
        foreach ($payment->getLinks() as $link){
            
            if($link->getRel() == 'approval_url'){

                $redirect_urls = $link->getHref();
                break;
            }
        }

        // add payment ID to session
        Session::put('paypal_payment_id', $payment->getId());

        // if the information provided is true with no error(s), redirect user
        if(isset($redirect_urls)){
            return Redirect::away($redirect_urls);
        }

        // catching the errors
        Session::put('error', 'Unknown error occured');
        return Redirect::to('checkout-index');
    }


    public function paymentStatus(Request $request)
    {
        //Get the payment ID before session clear
        $payment_id = Session::get('paypal_payment_id');

        // clear the session payment ID
        Session::forget('paypal_payment_id');

        // checking for empty payerID & Token

        // If (empty(input::get('PayerID')) || empty(input::get('token')))
        If (empty($request->PayerID) || empty($request->token)) {
            
            Session::put('error', 'Payment Failed');
            return Redirect::to('checkout-index');
        }

        // getting the payment ID and confirming the api_context
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();

        // setting the execution variable here
        
        // $execution->setPayerId(Input::get('PayerID'));
        $execution->setPayerId($request->PayerID);

        // Execute the payment
        $result = $payment->execute($execution, $this->_api_context);

        if($result->getState() == 'approved') {

            // Update records after successfull payment
            if(OrderCourier::where('user_id', Auth::id()))
            {
                $order = OrderCourier::latest()->first();
                $order->payment_mode = 'PayPal';
                $order->payment_id = $payment_id;
                $order->tracking_no = 'Gcourier'.rand(1111,9999);
                $order->status = 'New';
                $order->save();
            }
            // Back to Home page with sweet alert displaying the payment ID
            return Redirect::to('checkout-index')
            ->with('success', 'ORDER PLACED SUCCESSFULLY! ..your payment ID is : '. $payment_id);  
        }
        // catching the errors and exceptions
            Session::put('error', 'Payment failed');
            return Redirect::to('checkout-index');
        
    }
}
