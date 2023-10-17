<?php

namespace App\Http\Livewire\Admin\FrontService;

// livewire component,WithFileUploads=(image upload)and Front_Service model
use Livewire\Component;
use App\Models\Front_Service;
use Livewire\WithFileUploads;

class Add extends Component // add component
{
    use WithFileUploads; // image upload component
    
    // public variable where all required datas are saved.
    public $name;
    public $description;
    public $image;

    // The add service page(also displayed on the welcome page) from admin end, with $services 
    // variable that fetch data from the front_services page on DB.
    public function render()
    {
        $services = Front_Service::latest()->get();
        return view('livewire.admin.front-service.add', compact('services'));
    }

    public function store() // The store front_service function.
    {
        // This validate the required input from the add service page
        $this->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|mimes:svg',
        ]);

        // Store the datas here with the image in the public.services folder
        $image = $this->image->store('services', 'public');

        $services = new Front_Service();
        $services->name = $this->name;
        $services->description = $this->description;
        $services->image = $image;
        $services->save();

        session()->flash('success','Service Added Successfully!'); // session alert here
        $this->reset(); // reset the page back to initial
    }
}