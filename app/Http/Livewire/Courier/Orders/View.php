<?php

namespace App\Http\Livewire\Courier\Orders;

// livewire component and OrderCourie model
use Livewire\Component;
use App\Models\OrderCourier;
use App\Models\PaymentSettings;

class View extends Component
{
    // public variable where all datas are saved and ready for mounting.
    public $name;
    public $email;
    public $phone;
    public $gender;
    public $from_location;
    public $to_location;
    public $payment_mode;
    public $payment_id;
    public $product_name;
    public $product_type;
    public $service_price;
    public $image;
    public $order_id;
    public $order_status;


    // mount/show the saved data with assigned id on the courier view.order page
    public function mount($orders)
    {
        $this->name = $orders->name;
        $this->email = $orders->email;
        $this->phone = $orders->phone;
        $this->gender = $orders->gender;
        $this->from_location = $orders->from_location;
        $this->to_location = $orders->to_location;
        $this->payment_mode = $orders->payment_mode;
        $this->payment_id = $orders->payment_id;
        $this->product_name = $orders->product_name;
        $this->product_type = $orders->product_type;
        $this->image = $orders->image;
        $this->service_price = $orders->service_price;
        $this->order_id = $orders->id;
    }
    
    // The courier view order page, with variable $orders 
    // that fetch data from the orderCourier and users table on DB
    // and $orderId that fetch datas from only orderCourier table.
    public function render()
    {
        $orders = OrderCourier::where('order_couriers.id', $this->order_id)
        ->join('users', 'order_couriers.user_id', '=', 'users.id')
        ->first();
        $orderId = OrderCourier::where('id', $this->order_id)->first();
        $currency = PaymentSettings::all()->first();

        return view('livewire.courier.orders.view', compact('orders', 'orderId','currency'));
    }

}