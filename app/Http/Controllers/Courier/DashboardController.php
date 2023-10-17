<?php

namespace App\Http\Controllers\Courier;

// Used Models, Request, Carbon and Auth
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderCourier;
use App\Models\Service;
use App\Models\CourierModel;
use App\Models\PaymentSettings;
use App\Models\Company_master;
use Carbon\Carbon;

class DashboardController extends Controller
{
    // Constructing function for middleware
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // Courier dashboard index view function with variables
    // fetching data from orderCourier table from the DB, these
    // data are passed in the chart displaying in the dashoard
    public function index()
    {
        $data=OrderCourier::where('courier_id', Auth::id())->where('status', '3')
        ->select('id', 'created_at')->get()->groupBy(function($data){
            return Carbon::parse($data->created_at)->format('M');
        });
        
        // variables defined for the sales chart in the dashboard
        $months=[];
        $monthCount=[];
        foreach($data as $month => $values){
            $months[]=$month;
            $monthCount[]=count($values);
        }
        $countOrder=OrderCourier::where('status', '0')->count();    // Get Data for new orders
        $countOrderHistory = OrderCourier::where('status', '3')->where('courier_id', Auth::id())->count(); // Get Data for count completed orders
        $services = Service::latest()->get();   // Get Data for added services on the dashboard
        $courierInfo = CourierModel::where('user_id', Auth::id())->first(); // Get courier informations i.e name & image for display on dashboard
        $totalSales = OrderCourier::where('status', '3')->where('courier_id', Auth::id())->sum('service_price'); // Data for total amount of completed orders and sumation
        
        $reviews = OrderCourier::where('courier_id', Auth::id())->count('review'); // Data for reviews by users and count them all
        $currency = PaymentSettings::all()->first();
        $company_details = Company_master::where('id', 1)->first();

        // The dashboard view and all variables are compacted
        return view('courier.dashboard', compact('data', 'months', 'monthCount', 'countOrder', 'services',
                                                'courierInfo','countOrderHistory','totalSales','reviews','currency','company_details'));
        
    }


    // suspended page for couriers that are suspended by the admin,
    // with variable $courierInfo fetching the couriers data from the Courier table in the DB 
    public function SuspendedPage()
    {
        $company_details = Company_master::where('id', 1)->first();
        $courierInfo = CourierModel::where('user_id', Auth::id())->first();
        return view('courier.suspended.index', compact('courierInfo','company_details'));
    }
    

        
}