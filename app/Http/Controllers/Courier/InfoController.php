<?php

namespace App\Http\Controllers\Courier;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\CourierModel;
use App\Models\User;
use App\Models\Company_master;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function courierInfo()
    {
        $company_details = Company_master::where('id', 1)->first();
        $courierInfo = CourierModel::where('user_id', Auth::id())->first();
        return view('courier.info.index', compact('courierInfo','company_details'));
    }

    public function courierInfos(Request $request)
    {
        $courierInfo = CourierModel::where('user_id',  Auth::id())->first();

        if($image = $request->image)
        {
            $courierName=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('courierimage', $courierName);
            $courierInfo->image = $courierName;
        }

        $courierInfo->name = $request->name;
        $courierInfo->email = $request->email;
        $courierInfo->gender = $request->gender;
        $courierInfo->phone = $request->phone;
        $courierInfo->address = $request->address;
        $courierInfo->city = $request->city;
        $courierInfo->state = $request->state;
        $courierInfo->country = $request->country;
        $courierInfo->vehicle = $request->vehicle;
        $courierInfo->update();

        $user = User::where('id', Auth::id())->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->state = $request->state;
        $user->country = $request->country;
        $user->pincode = $request->pincode;
        $user->update();

        return redirect()->back()->with('success', "Your Details Updated");
    }
}
