<?php

namespace App\Http\Controllers\Admin;

// Used Models, Request and Carbon
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderCourier;
use App\Models\User;
use App\Models\AddCourier;
use App\Models\CourierModel;
use App\Models\Contact;
use App\Models\Service;
use App\Models\Todo;
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
    
    // Admin dashboard index view function with variables
    // fetching data from orderCourier table from the DB, these
    // data are passed in the chart displaying in the dashoard
    public function index()
    {
        $data=OrderCourier::where('status', '3')->select('id', 'created_at')
        ->get()->groupBy(function($data){
            return Carbon::parse($data->created_at)->format('M');
        });

        // variables defined for the sales chart in the dashboard
        $months=[];
        $monthCount=[];
        foreach($data as $month => $values){
            $months[]=$month;
            $monthCount[]=count($values);
        }
        $countOrder=OrderCourier::where('status', '<=', 2)->count();  // Get Data for new orders
        $countUser=User::where('role_id', 0)->count();  // Get Data & count registered Users
        $countCourier=CourierModel::all()->count();  // Get Data & count registered Models
        $countTotalSales =OrderCourier::where('status', 3)->count();  // Get Data & count completed orders
        $countmessages = Contact::where('unread', 1)->count();  // Get Data & count all sent messages
        $showmessages = Contact::latest()->paginate(3);  // Get Data for latest 3 sent messages
        $services = Service::latest()->get();  // Get Data for services
        $todoLists = Todo::latest()->get();  // Get Data for todo list
        $currency = PaymentSettings::all()->first();
        $company_details = Company_master::where('id', 1)->first();

        // The dashboard view and all variables are compacted
        return view('admin.dashboard', compact('data', 'months', 'monthCount', 'countOrder', 
                                                'countCourier', 'countUser', 'countTotalSales',
                                                 'countmessages', 'showmessages', 'services', 
                                                 'todoLists','currency', 'company_details'));
    }
    

    // The todo view function
    public function addTodo(Request $request)
    {
        $todo = new Todo();

        $todo->activity=$request->input('activity');
        $todo->save();

        // back to the sam page after added a todo
        return redirect()->back()->with('status', 'Activity Added');
    }

    // delete todo function here
    public function deleteTodo($id)
    {
        Todo::find($id)->delete();
        return redirect()->back()->with('status','User Deleted Successfully!');
    }
}