<?php

namespace App\Http\Controllers\Admin;

// Used Models,Str, Storage, File, Image, Carbon and Request
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;

use App\Models\Company_master;
use App\Models\Service;
use App\Models\User;
use App\Models\Contact;
use App\Models\AddCourier;
use App\Models\OrderCourier;
use App\Models\PaymentSettings;

class CompanyController extends Controller
{
    // Constructing function for middleware
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // company index function from the admin end with $companies,fetching some datas 
    // from company_masters table and $showmessages & $countmessages both variables 
    // fetching some datas from Contact table from the DB
    public function index()
    {
        $companies = Company_master::all();
        $countmessages = Contact::where('unread', 1)->count();
        $showmessages = Contact::latest()->paginate(3);
        $company_details = Company_master::where('id', 1)->first();

        // if there is one or more data in the company_masters table 
        if(count($companies) > 0) 
        {
            $company = Company_master::find(1);
            $company_details = Company_master::where('id', 1)->first();
            return view('admin.company.index', compact('companies', 'company','countmessages', 
                                                        'showmessages','company_details'));
        }
        // if there is no data in the company_masters table 
        else{
            return view('admin.company.index', compact('companies', 'countmessages', 
                                                        'showmessages','company_details'));
        }
    }


    // the store function for the company details from the admin end
    public function store(Request $request)
    {
        // This validate the required input from the company index page
        $this->validate($request,[
            'company_name' => 'required|string',
            'company_logo' => 'required|image|mimes:jpeg,jpg,png,bmp',
            'address' => 'required',
            'company_city' => 'required',
            'company_state' => 'required',
            'company_pin' => 'required',
            'company_country' => 'required|string',
            'company_phone' => 'required|string',
            'company_email' => 'required|email',
            'company_gst' => 'required|string',
        ]);

        // if company name and logo is present, the display the view on the page
        $slug = Str::slug($request->company_name);
        $image = $request->file('company_logo');
        if(isset($image))
        {
            $date = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $date . '-' . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('company'))
            {
              Storage::disk('public')->makeDirectory('comapny'); 
            }
            
            
            $companyLogo = Image::make($image)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('company/' .$imageName,$companyLogo);
        }

        // if the company name and other details is not stored, the request from input
            else{
                $imageName = 'default.png';
            }
            $company = new Company_master();
            $company->company_name = $request->company_name;
            $company->company_logo = $imageName;
            $company->address = $request->address;
            $company->company_city = $request->company_city;
            $company->company_state = $request->company_state;
            $company->company_pin = $request->company_pin;
            $company->company_country = $request->company_country;
            $company->company_phone = $request->company_phone;
            $company->company_email = $request->company_email;
            $company->company_gst = $request->company_gst;
            $company->save();

            // back to the same page with sweet alert
            return redirect()->back()->with('success', 'Company Details Saved Successfully!');
        }

        // The update company function, updates the edited inputs and 
        // company logo in the company_masters from the DB from the admin end
    
    
    public function update(Request $request)
    {
        // This validate the required input from the add courier page
        $this->validate($request,[
            'company_name' => 'required|string',
            'company_logo' => 'image|mimes:jpeg,jpg,png,bmp',
            'address' => 'required',
            'company_city' => 'required',
            'company_state' => 'required',
            'company_pin' => 'required',
            'company_country' => 'required|string',
            'company_phone' => 'required|string',
            'company_email' => 'required|email',
            'company_gst' => 'required|string',
        ]);

        // if there is one or more data in the company_masters 
        // table, hence this display of this view
        $company = Company_master::find(1);
        $slug = Str::slug($request->company_name);
        $image = $request->file('company_logo');
        if(isset($image))
        {
            $date = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $date . '-' . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('company'))
            {
                Storage::disk('public')->makeDirectory('comapny'); 
            }
            
            if(Storage::disk('public')->exists('company/' .$company->company_logo))
            {
                Storage::disk('public')->delete('company/' .$company->company_logo); 
            }
            $companyLogo = Image::make($image)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('company/' .$imageName,$companyLogo);
        }

        // if the company name and other details is not stored, 
        // then request data from input on the company index paage
            else{
                $imageName = $company->company_logo;
            }
            
            $company->company_name = $request->company_name;
            $company->company_logo = $imageName;
            $company->address = $request->address;
            $company->company_city = $request->company_city;
            $company->company_state = $request->company_state;
            $company->company_pin = $request->company_pin;
            $company->company_country = $request->company_country;
            $company->company_phone = $request->company_phone;
            $company->company_email = $request->company_email;
            $company->company_gst = $request->company_gst;
            $company->save();

            // back to the same page with sweet alert
            return redirect()->back()->with('success', 'Company Details Updated Successfully!');
    }

    // service index page function from the admin end
    public function service()
    {
        $services = Service::latest()->get();
        $countmessages = Contact::where('unread', 1)->count();
        $showmessages = Contact::latest()->paginate(3);
        $currency = PaymentSettings::all()->first();
        $company_details = Company_master::where('id', 1)->first();
        return view('admin.service.index', compact('services', 'countmessages', 'showmessages',
                                                    'currency','company_details'));
    }

    // add index page function for services from the admin end
    public function add()
    {
        $countmessages = Contact::where('unread', 1)->count();
        $showmessages = Contact::latest()->paginate(3);
        $company_details = Company_master::where('id', 1)->first();
        return view('admin.service.add', compact('countmessages', 'showmessages','company_details'));
    }

    // edit page function with assigned ID for service from the admin end
    public function edit($id)
    {
        $service = Service::find($id);
        $countmessages = Contact::where('unread', 1)->count();
        $showmessages = Contact::latest()->paginate(3);
        $company_details = Company_master::where('id', 1)->first();
        return view('admin.service.edit', compact('service','countmessages', 'showmessages','company_details'));
    }

    // delete services function here from the admin end
    public function delete($id)
    {
        Service::find($id)->delete();
        return redirect()->back()->with('success','Service Deleted Successfully!');
    }

    // users index view function from the admin end
    public function users()
    {
        $admin = User::where('role_id', 1)->first();
        $users = User::where('role_id', 0)->latest()->get();
        $company_details = Company_master::where('id', 1)->first();

        $countmessages = Contact::where('unread', 1)->count();
        $showmessages = Contact::latest()->paginate(3);
        return view('admin.users.index', compact('admin','users','countmessages', 'showmessages','company_details'));
    }

    // edit users function here from the admin end
    public function edit_view($id)
    {
        $users = User::find($id);
        $countmessages = Contact::where('unread', 1)->count();
        $showmessages = Contact::latest()->paginate(3);
        $company_details = Company_master::where('id', 1)->first();
        return view('admin.users.edit', compact('users','countmessages', 'showmessages','company_details'));
    }

    // user update function from admin end
    public function update_user(Request $request, $id)
    {
        $users = User::find($id);

        $users->name=$request->input('name');
        $users->email=$request->input('email');
        $users->phone=$request->input('phone');
        $users->city=$request->input('city');
        $users->state=$request->input('state');
        $users->country=$request->input('country');
        $users->gender=$request->input('gender');
        $users->pincode=$request->input('pincode');
        $users->address=$request->input('address');
        $users->save();

        // back to the same page with sweet alert
        return redirect()->back()->with('success', 'User Updated succefully');
    }

    // delete users function here from the admin end
    public function user_delete($id)
    {
        User::find($id)->delete();
        return redirect()->back()->with('success','User Deleted Successfully!');
    }

    // recieved messages view function here
    public function messages()
    {
        $messages = Contact::latest()->get();
        $countmessages = Contact::where('unread', 1)->count();
        $showmessages = Contact::latest()->paginate(3);
        $company_details = Company_master::where('id', 1)->first();
        
        return view('admin.actions.messages', compact('messages', 'countmessages', 'showmessages','company_details'));
    }

    // applied couriers view function here
    public function appliedCourier()
    {
        $appliedCouriers = AddCourier::latest()->get();
        $countmessages = Contact::where('unread', 1)->count();
        $showmessages = Contact::paginate(3);
        $company_details = Company_master::where('id', 1)->first();
        return view('admin.actions.appliedCouriers', compact('appliedCouriers', 'countmessages', 'showmessages','company_details'));
    }

    // update function of the messages that has been read
    public function messagesRead(Request $request, $id)
    {
        $message = Contact::find($id);
        $message ->unread = $request->read;
        $message -> update();
        
        return redirect()->back();
    }
        
    // delete function for the recieved messages here
    public function message_delete($id)
    {
        $message = Contact::find($id)->delete();
        return redirect()->back()->with('status', 'Message Deleted!');
    }

}