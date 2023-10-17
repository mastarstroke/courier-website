<?php

namespace App\Http\Controllers\Admin;

// Used Models, Hash password and Request
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourierModel;
use App\Models\Contact;
use App\Models\OrderCourier;
use App\Models\User;
use App\Models\Branch;
use App\Models\Company_master;

use Illuminate\Support\Facades\Hash;

class CourierController extends Controller
{
    // Constructing function for middleware
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // courier index function from the admin end with $countmessages 
    // & $showmessages both variables fetching some datas from Contact table from the DB
    public function index(Request $request)
    {
        $couriers = CourierModel::latest()->get();
        $company_details = Company_master::where('id', 1)->first();
        
        $countmessages = Contact::where('unread', 1)->count();
        $showmessages = Contact::latest()->paginate(3);
        return view('admin.courier.index', compact('couriers', 'countmessages', 'showmessages','company_details'));
    }

    // the add view function for the couriers from the admin end
    public function add(Request $request)
    {
        $image=$request->image;
        $branchs = Branch::all();
        $countmessages = Contact::where('unread', 1)->count();
        $showmessages = Contact::latest()->paginate(3);
        $company_details = Company_master::where('id', 1)->first();
        return view('admin.courier.add', compact( 'countmessages', 'showmessages', 'image', 'branchs','company_details'));
    }

    // the store function for the couriers from the admin end
    public function addCourier(Request $request)
    {
        // This validate the required input from the add courier page
        $this->validate($request,[
            'name' => 'required|string',
            'role_id' => 'required|string',
            'branch' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'vehicle' => 'required|string',
            'gender' => 'required|string',
            'address' => 'required',
            'city' => 'required|string',
            'state' => 'required|string',
            'pincode' => 'required|string',
            'country' => 'required|string',
            'password' => 'required|string',
            'image' => 'required|image|mimes:jpeg,jpg,png,bmp',
        ]);
        

        // Store the datas here with the image in the public.courierimage folder
        // into the courierModels table and users table.

        $image=$request->image;
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $request->image->move('courierimage', $imagename);

        $user = new User();
        $user->role_id = $request->role_id;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->country = $request->country;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->pincode = $request->pincode;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->save();

        $courier = new CourierModel();
        $courier->user_id = $user->id;
        $courier->role_id = $request->role_id;;
        $courier->image = $imagename;
        $courier->name = $request->name;
        $courier->branch = $request->branch;
        $courier->email = $request->email;
        $courier->phone = $request->phone;
        $courier->vehicle = $request->vehicle;
        $courier->gender = $request->gender;
        $courier->address = $request->address;
        $courier->city = $request->city;
        $courier->state = $request->state;
        $courier->country = $request->country;
        $courier->pincode = $request->pincode;
        $courier->password =$request->password;
        $courier->save();

        return redirect()->back()->with('success','Courier Added Successfully!');// sweet alert here
        $this->reset();  // reset the page back to initial
    }

    // The edit courier page from admin end, with $branchs  and $couriers
    // variables that fetch data from the branches and courierModels table respectively from DB.
    public function edit($id)
    {
        $couriers = CourierModel::find($id);
        $branchs = Branch::all();
        $countmessages = Contact::where('unread', 1)->count();
        $showmessages = Contact::latest()->paginate(3);
        $company_details = Company_master::where('id', 1)->first();
        return view('admin.courier.edit', compact('couriers', 'branchs', 'countmessages', 'showmessages','company_details'));
    }

     // The update courier function, updates the edited inputs and image in both
    //  courierModel and users tables from the DB from the admin end
    public function updateCourier(Request $request, $id)
    {
        // This validate the required input from the add courier page
        $this->validate($request,[
            'name' => 'required|string',
            'role_id' => 'required|string',
            'branch' => 'required|string',
            'phone' => 'required|string',
            'vehicle' => 'required|string',
            'gender' => 'required|string',
            'address' => 'required',
            'city' => 'required|string',
            'state' => 'required|string',
            'pincode' => 'required|string',
            'country' => 'required|string',
            'password' => 'required|string',
        ]);

                
        $courier = CourierModel::find($id);

        if($image=$request->image){
            $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('courierimage', $imagename);
            $courier->image = $imagename;
        }

        $courier->name = $request->name;
        $courier->branch = $request->branch;
        $courier->phone = $request->phone;
        $courier->vehicle = $request->vehicle;
        $courier->gender = $request->gender;
        $courier->address = $request->address;
        $courier->city = $request->city;
        $courier->state = $request->state;
        $courier->country = $request->country;
        $courier->pincode = $request->pincode;
        $courier->password =$request->password;
        $courier->update();

        $user = User::where('id', $courier->user_id)->first();
        $user->role_id = $request->role_id;
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->country = $request->country;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->pincode = $request->pincode;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->update();

        return redirect()->back()->with('success','Courier Updated Successfully!');
    }

    // The courier delete function 
    public function delete($user_id)
    {         
        $courier = CourierModel::where('user_id', $user_id)->delete();
        $user = User::where('id', $user_id)->delete();
    
        return redirect()->back()->with('success','Courier Deleted Successfully!');
    }

    // this is the function that suspend and unsuspend couriers by 
    // changing their roles in the user and courierModel tables from the admin end
    public function suspendCourier(Request $request, $user_id)
    {
        $suspendCourier = CourierModel::where('user_id', $user_id)->first();
        $suspendCourier->role_id = $request->role_id;
        $suspendCourier->update();

        $suspendInUser = User::where('id', $user_id)->first();
        $suspendInUser->role_id = $request->role_id;
        $suspendInUser->update();
 
        // back to the sam page with a session alert
        return redirect()->back()->with('success', "A Courier Status Changed!");
    }

   

    
}