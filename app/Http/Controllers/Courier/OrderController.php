<?php

namespace App\Http\Controllers\Courier;

// Used Models, Request and Auth
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderCourier;
use App\Models\CourierModel;
use App\Models\PaymentSettings;
use App\Models\Company_master;

class OrderController extends Controller
{
    // Constructing function for middleware
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // order index view function with $courierInfo &  $orders
    // variables fetching some datas from courierModel & orderCourier table respectively in the DB
    public function newOrders()
    {
        $company_details = Company_master::where('id', 1)->first();
        $courierInfo = CourierModel::where('user_id', Auth::id())->first();
        $orders = OrderCourier::where('status', '0')->latest()->get();
        $currency = PaymentSettings::all()->first();
        return view('courier.orders.index', compact('orders','courierInfo','currency','company_details'));
    }

    // courier view order page with assigned ID for the specific order, w
    // with variables fetching data from the orderModels and courierModel
    public function vieworder($id)
    {
        $company_details = Company_master::where('id', 1)->first();
        $courierInfo = CourierModel::where('user_id', Auth::id())->first();
        $orders = OrderCourier::find($id);
        $orderId = OrderCourier::where('id', $id)->first();

        return view('courier.orders.view', compact('orders', 'orderId','courierInfo','company_details'));
    }

    // courier update the order here to ride and notify 
    // the admin that the order is by take by a specific courier
    public function updateorder(Request $request, $id)
    {
        $orders = OrderCourier::find($id);
        $orders->courier_id = Auth::id();
        $orders->courier = Auth::user()->name;
        $orders->status = $request->order_status;
        $orders->save();

        // redirect to courier ride page here
        return redirect()->route('courier.courier-ride', $id);
    }

    // Courier ride page after courier taken the ride from the view page
    // this section where courier deliver the items 
    public function courierRide($id)
    {
        $courier_check = OrderCourier::where('courier_id', Auth::id())->first();

        if($courier_check)
        {
            $company_details = Company_master::where('id', 1)->first();
            $courierInfo = CourierModel::where('user_id', Auth::id())->first();
            $orders = OrderCourier::where('order_couriers.id', $id)
            ->join('users', 'order_couriers.user_id', '=', 'users.id')
            ->first();
            $orderId = OrderCourier::where('id', $id)->first();
            $currency = PaymentSettings::all()->first();
            
            return view('livewire.courier.orders.ride', compact('courierInfo','orders','orderId','currency','company_details'));
        }
    }

    // courier order history here
    public function orderCompleted()
    {
        $company_details = Company_master::where('id', 1)->first();
        $courierInfo = CourierModel::where('user_id', Auth::id())->first();
        $orders = OrderCourier::where('status', '3')->where('courier_id', Auth::id())->get();
        $currency = PaymentSettings::all()->first();
        return view('courier.orders.history', compact('orders','courierInfo','currency','company_details'));
    }
    
}