<?php

namespace App\Http\Controllers;

// Used Models  and Request
use Illuminate\Http\Request;
use App\Models\AddCourier;
use App\Models\Contact;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    // Store function for courier form from the welcome page
    public function courierForm(Request $request)
    {
        $addcourier = new AddCourier();
        $addcourier->name = $request->name;
        $addcourier->email = $request->email;
        $addcourier->phone = $request->phone;
        $addcourier->address = $request->address;
        $addcourier->gender = $request->gender;
        $addcourier->vehicle = $request->vehicle;
        $addcourier->save();

        // Back to the same page with sweet alert
        return redirect()->back()->with('success', "Application Subnitted! We will get back to you soon.");
    }

    // Store function for the popup contact form, from welcome page
    public function contactForm(Request $request)
    {
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject= $request->subject;
        $contact->comment = $request->comment;
        $contact->save();

        // Back to the same page with sweet alert
        return redirect()->back()->with('success', "Message Recieved! Await our response through email");
    }
}