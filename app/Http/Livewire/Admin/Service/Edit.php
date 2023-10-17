<?php

namespace App\Http\Livewire\Admin\Service;

// livewire component and Services model
use Livewire\Component;
use App\Models\Service;

class Edit extends Component // edit component
{
    // public variable where all datas are saved.
    public $service_name;
    public $price;
    public $per_kg_rate;
    public $description;
    public $service_id;

    // mount/show the saved data with assigned id on the courier edit.service page
    public function mount($service) 
    {
        $this->service_name = $service->service_name;
        $this->price = $service->price;
        $this->per_kg_rate = $service->per_kg_rate;
        $this->description = $service->description;
        $this->service_id = $service->id;
    }

    // The edit service page form admin end.
    public function render()
    {
        return view('livewire.admin.service.edit');
    }

    public function update() // The update service function.
    {
        // This validate the required input from the edit service page
        $this->validate([
            'service_name' => 'required|string',
            'price' => 'required|integer',
            'per_kg_rate' => 'required|string',
            'description' => 'required|string',
        ]);

        // Update the datas here.
        $service = Service::find($this->service_id);
        $service->service_name = $this->service_name;
        $service->price = $this->price;
        $service->per_kg_rate = $this->per_kg_rate;
        $service->description = $this->description;
        $service->save();
        session()->flash('success','Service Updated Successfully!'); // session alert here
    }
}