<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Contact;
use App\Models\Front_Service;
use App\Models\SectionOne;
use App\Models\SectionTwo;
use App\Models\PaymentSettings;
use App\Models\Currency;
use App\Models\Company_master;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    // Constructing function for middleware
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // front services index function from the admin end with $countmessages 
    // & $showmessages both variables fetching some datas from Contact table from the DB
    public function index()
    {
        $countmessages = Contact::where('unread', 1)->count();
        $showmessages = Contact::latest()->paginate(3);
        $company_details = Company_master::where('id', 1)->first();
        return view('admin.frontService.index', compact('countmessages', 'showmessages','company_details'));
    }

    // edit view function for the front services from the admin end
    public function edit($id)
    {
        $services = Front_Service::find($id);
        $countmessages = Contact::where('unread', 1)->count();
        $showmessages = Contact::latest()->paginate(3);
        $company_details = Company_master::where('id', 1)->first();
        return view('admin.frontService.edit', compact('services', 'countmessages', 'showmessages','company_details'));
    }

    // delete services function here
    public function delete($id)
    {
        Front_Service::find($id)->delete();
        return redirect()->back()->with('success','Service Deleted Successfully!');
    }


    public function paymentSettings()
    {
        $countmessages = Contact::where('unread', 1)->count();
        $showmessages = Contact::latest()->paginate(3);
        $payment = PaymentSettings::all()->first();
        $currency = Currency::all();
        $company_details = Company_master::where('id', 1)->first();
        return view('admin.settings.payment', compact('payment', 'countmessages', 'showmessages', 'currency','company_details'));
    }

    public function paymentSetting(Request $request)
    {
        $setting = PaymentSettings::find(1);

        $setting->currency = $request->currency;
        $setting->paypal = $request->paypal == TRUE ? '1': '0';
        $setting->stripe = $request->stripe == TRUE ? '1': '0';
        $setting->paystack = $request->paystack == TRUE ? '1': '0';
        $setting->razorpay = $request->razorpay == TRUE ? '1': '0';
        $setting->cod = $request->cod == TRUE ? '1': '0';
        $setting->update();
        
        return redirect()->back()->with('success', "Payment Options Updated");

    }

    public function currencyAdd()
    {
        $countmessages = Contact::where('unread', 1)->count();
        $showmessages = Contact::latest()->paginate(3);
        $company_details = Company_master::where('id', 1)->first();
        return view('admin.settings.addcurrency', compact('countmessages', 'showmessages', 'company_details'));
    }

    public function currencyStore(Request $request)
    {
        $currency = new Currency();

        $currency->name = $request->name;
        $currency->sign = $request->sign;

        $currency->save();

        return redirect()->back()->with('success', "Currency Added");
    }

    public function appearances()
    {
        $countmessages = Contact::where('unread', 1)->count();
        $showmessages = Contact::latest()->paginate(3);

        $setting_one = SectionOne::first();
        $setting_two = SectionTwo::first();
        $company_details = Company_master::where('id', 1)->first();
        return view('admin.settings.appearance', compact('countmessages', 'showmessages','setting_one', 'setting_two','company_details'));
    }

    public function sectionOne(Request $request)
    {
        //  $this->validate($request,[
        //     'hero_title' => 'string',
        //     'hero_paragraph' => 'string',
        //     'hero_image' => 'required|image|mimes:jpeg,jpg,png,bmp',
        //     'about_title' => 'string',
        //     'about_paragraph' => 'string',
        //     'about_image' => 'required|image|mimes:jpeg,jpg,png,bmp',
        // ]);

        $settings = SectionOne::find(1);

        if($image = $request->hero_image)
        {
            $heroName=time().'.'.$image->getClientOriginalExtension();
            $request->hero_image->move('settingsimage', $heroName);
            $settings->hero_image = $heroName;
        }
        $settings->hero_title = $request->hero_title;
        $settings->hero_paragraph = $request->hero_paragraph;


        if($image=$request->about_image){
            $aboutName=time().'.'.$image->getClientOriginalExtension();
            $request->about_image->move('settingsimage', $aboutName);
            $settings->about_image = $aboutName;
        }
        $settings->about_title = $request->about_title;
        $settings->about_paragraph = $request->about_paragraph;

        $settings->update();

        return redirect()->back()->with('success', "Section-one Updated");
    }

    public function sectionTwo(Request $request)
    {
         $this->validate($request,[
            'how_title' => 'string',
            'how_paragraph' => 'string',
            'how_image' => 'image|mimes:jpeg,jpg,png,bmp',
            'contact_title' => 'string',
            'contact_paragraph' => 'string',
            'contact_image' => 'image|mimes:jpeg,jpg,png,bmp',
        ]);

        $settings = SectionTwo::find(1);

        if($image = $request->how_image){
            $howName=time().'.'.$image->getClientOriginalExtension();
            $request->how_image->move('settingsimage', $howName);
            $settings->how_image = $howName;
        }
        $settings->how_title = $request->how_title;
        $settings->how_paragraph = $request->how_paragraph;


        if($image=$request->contact_image){
            $contactName=time().'.'.$image->getClientOriginalExtension();
            $request->contact_image->move('settingsimage', $contactName);
            $settings->contact_image = $contactName;
        }
        $settings->contact_title = $request->contact_title;
        $settings->contact_paragraph = $request->contact_paragraph;

        if($image=$request->contact_us){
            $contactUs=time().'.'.$image->getClientOriginalExtension();
            $request->contact_us->move('settingsimage', $contactUs);
            $settings->contact_us = $contactUs;
        }

        $settings->update();

        return redirect()->back()->with('success', "Section-two Updated");
    }

}
