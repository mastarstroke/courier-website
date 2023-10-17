<?php

namespace App\Http\Controllers\Admin;

// Used Models and Request
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Contact;
use App\Models\Company_master;

class BranchController extends Controller
{
    // Constructing function for middleware
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // branch index view function from admin end
    public function index()
    {
        $branches = Branch::latest()->get();
        $countmessages = Contact::where('unread', 1)->count();
        $showmessages = Contact::latest()->paginate(3);
        $company_details = Company_master::where('id', 1)->first();
        return view('admin.branch.index', compact('branches', 'countmessages', 'showmessages', 'company_details'));
    }

    // add branch view page function here
    public function add()
    {
        $countmessages = Contact::where('unread', 1)->count();
        $showmessages = Contact::latest()->paginate(3);
        $company_details = Company_master::where('id', 1)->first();
        return view('admin.branch.add', compact('countmessages', 'showmessages','company_details'));
    }

    // edit branch view page function
    public function edit($id)
    {
        $branch = Branch::find($id);
        $countmessages = Contact::where('unread', 1)->count();
        $showmessages = Contact::latest()->paginate(3);
        $company_details = Company_master::where('id', 1)->first();
        return view('admin.branch.edit', compact('branch', 'countmessages', 'showmessages','company_details'));
    }

    // delete branch here
    public function delete($id)
    {
        Branch::find($id)->delete();
        return redirect()->back()->with('success','Branch Deleted Successfully!');
    }
}