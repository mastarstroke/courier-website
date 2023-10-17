<?php

namespace App\Http\Livewire\Admin\Service;

// livewire component and Services model
use Livewire\Component;
use App\Models\Service;

class Add extends Component // add component
{
    // public variable where all datas are saved.
    public $service_name;
    public $price;
    public $per_kg_rate;
    public $description;

    // The add service page form admin end.
    public function render()
    {
        return view('livewire.admin.service.add');
    }

    public function store() // The store service function.
    {
        // This validate the required input from the add service page
        $this->validate([
            'service_name' => 'required|string',
            'price' => 'required|string',
            'per_kg_rate' => 'required|string',
            'description' => 'required|string',
        ]);

        // Store the datas here.
        $service = new Service();
        $service->service_name = $this->service_name;
        $service->price = $this->price;
        $service->per_kg_rate = $this->per_kg_rate;
        $service->description = $this->description;
        $service->save();
        session()->flash('success','Service Added Successfully!'); // session alert here
        $this->reset(); // reset the page back to initial
    }
}