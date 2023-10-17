<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\OrderCourier;
use App\Models\PaymentSettings;
use App\Models\Company_master;


class OrderController extends Controller
{
    // Constructing function for middleware
    public function __construct()
    {
        $this->middleware('auth');
    }
        
    // function for the new orders from admin end
    public function orders()
    {
        $countmessages = Contact::where('unread', 1)->count();
        $showmessages = Contact::paginate(3);

        $orders = OrderCourier::where('status', '<=', 2)->latest()->get();
        $currency = PaymentSettings::all()->first();
        $company_details = Company_master::where('id', 1)->first();
        
        return view('admin.orders.index', compact('orders', 'countmessages', 'showmessages','currency','company_details'));
    
    }

    // view a specific orders from admin end
    public function vieworder($id)
    {
        $countmessages = Contact::where('unread', 1)->count();
        $showmessages = Contact::paginate(3);
        
        $orders = OrderCourier::where('order_couriers.id', $id)
        ->join('users', 'order_couriers.user_id', '=', 'users.id')
        ->first();
        
        $orderId = OrderCourier::where('id', $id)->first();
        $currency = PaymentSettings::all()->first();
        $company_details = Company_master::where('id', 1)->first();

        return view('admin.orders.view', compact('orders', 'orderId', 'countmessages', 'showmessages','currency','company_details'));
    }

    // delete a specific order from admin end
    public function order_delete($id)
    {
        $order = OrderCourier::find($id)->delete();    
        return redirect()->back()->with('success','Order Deleted!');
    }
    
    // update order either to pending or completed by the admin
    public function updateorder(Request $request, $id)
    {
        $order = OrderCourier::find($id);
        $order->status = $request->order_status;
        $order->update();

        return redirect()->back()->with('status', "Order Updated Successfully");
    }

    // completed orders here from the admin end
    public function orderHistory()
    {
        $countmessages = Contact::where('unread', 1)->count();
        $showmessages = Contact::paginate(3);
        $orders = OrderCourier::where('status', '3')->latest()->get();
        $currency = PaymentSettings::all()->first();
        $company_details = Company_master::where('id', 1)->first();
        return view('admin.orders.history', compact('orders', 'countmessages', 'showmessages','currency','company_details'));
    }
}
