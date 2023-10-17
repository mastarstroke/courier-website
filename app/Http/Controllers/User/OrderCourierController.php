<?php

namespace App\Http\Controllers\User;

// Used Models, Request and Auth
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderCourier;
use App\Models\Front_Service;
use App\Models\Service;
use App\Models\User;
use App\Models\PaymentSettings;

class OrderCourierController extends Controller
{
    // Constructing function for middleware
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Add Order view function with $services & $front_services
    // variables fetching some datas from services & front_services table respectively in the DB
    public function index()
    {
        $services = Service::latest()->get();
        $front_services = Front_Service::latest()->get();
        return view('user.order.add', compact('services', 'front_services'));
    }

    // Storing the order data including image input by users into the orderCourier table in the DB
    public function orderCourier(Request $request)
    { 
        $orders = new OrderCourier();

        $image=$request->image;

        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('orderimage', $imagename);

        $orders->image=$imagename;
        $orders->user_id = Auth::id();
        $orders->product_name = $request->product_name;
        $orders->product_type = $request->product_type;
        $orders->service_price = $request->service_price;
        $orders->from_location = $request->from_location;
        $orders->to_location = $request->to_location;
        $orders->save();

        // redirect to checkout page 
        return redirect('checkout-index');
    }
    
    // order view variable $orders fetchin data from orderCourier table in the DB
    // Authenticating the user and getting the lesser figure of the column "status"
    public function orders()
    {
        $orders = OrderCourier::where('user_id', Auth::id())
        ->where('status', '<=', 2)->latest()->get();

        $currency = PaymentSettings::all()->first();
        return view('user.order.index', compact('orders', 'currency'));
    }

    // user getting the order with inserted data from the the assigned ID 
    public function viewOrders($id)
    {
        $orders = OrderCourier::where('order_couriers.id', $id)
        ->join('users', 'order_couriers.user_id', '=', 'users.id')
        ->first();

        $currency = PaymentSettings::all()->first();
        $orderId = OrderCourier::where('id', $id)->first();
        return view('user.order.view', compact('orders', 'orderId', 'currency'));
    }

    public function cancel_orders(Request $request, $id)
    {
        $cancelOrder = OrderCourier::find($id);
        $cancelOrder->status = $request->input('cancel-order');
        $cancelOrder->update();
        return redirect()->back()->with('success', 'Order Cancelled');
    }

    // order history view here
    public function orderHistory()
    {
        $orders = OrderCourier::where('user_id', Auth::id())
        ->where('status', '3')->latest()->get();

        $currency = PaymentSettings::all()->first();
        return view('user.order.history', compact('orders', 'currency'));
    }

    // order review view here
    public function orderReview(Request $request, $id)
    {
        $orders = OrderCourier::find($id);
        $orders->review = $request->review;
        $orders->save();

        // back to the same page with sweet alert
        return redirect()->back()->with('success', 'Review Recieved. Thanks!');
    }
}