<?php

namespace App\Http\Livewire\Admin\Branch;

// livewire component and Branch model.
use Livewire\Component;
use App\Models\Branch;

class Edit extends Component // edit component
{
    // public variable where all required datas are saved.
    public $branch_name;
    public $branch_email;
    public $branch_phone;
    public $branch_address;
    public $branch_city;
    public $branch_state;
    public $branch_pin;
    public $branch_country;
    public $branch_id;

    // mount/show the saved data with assigned id on the admin edit branch page
    public function mount($branch)
    {
        $this->branch_name = $branch->branch_name;
        $this->branch_email = $branch->branch_email;
        $this->branch_phone = $branch->branch_phone;
        $this->branch_address = $branch->branch_address;
        $this->branch_city = $branch->branch_city;
        $this->branch_state = $branch->branch_state;
        $this->branch_pin = $branch->branch_pin;
        $this->branch_country = $branch->branch_country;
        $this->branch_id = $branch->id;
    }

    // The edit brand page from admin end.
    public function render()
    {
        return view('livewire.admin.branch.edit');
    }

    public function update() // The update branch function.
    {
        // This validate the required input from the edit branch page
        $this->validate([
            'branch_name' => 'required|string',
            'branch_email' => 'required|email',
            'branch_phone' => 'required|string',
            'branch_address' => 'required',
            'branch_city' => 'required|string',
            'branch_state' => 'required|string',
            'branch_pin' => 'required|string',
            'branch_country' => 'required|string',
        ]);

        // Update the datas here into the branches table form DB.
        $branch = Branch::find($this->branch_id);
        $branch->branch_name = $this->branch_name;
        $branch->branch_email = $this->branch_email;
        $branch->branch_phone = $this->branch_phone;
        $branch->branch_address = $this->branch_address;
        $branch->branch_city = $this->branch_city;
        $branch->branch_state = $this->branch_state;
        $branch->branch_country = $this->branch_country;
        $branch->branch_pin = $this->branch_pin;
        $branch->save();
        session()->flash('success','Branch Updated Successfully!'); // session alert here
    }
}