<?php

namespace App\Http\Livewire\Admin\FrontService;

// livewire component,WithFileUploads=(image upload)and Front_Service model
use Livewire\Component;
use App\Models\Front_Service;
use Livewire\WithFileUploads;

class Edit extends Component // edit component
{
    use WithFileUploads; // image upload component
    
    // public variable where all datas are saved.
    public $name;
    public $description;
    public $image;
    public $service_id;

    // mount/show the saved data with assigned id on the admin front_service page
    public function mount($services)
    {
        $this->name = $services->name;
        $this->description= $services->description;
        $this->image = $services->image ;
        $this->service_id = $services->id;
    }


    // The edit service page(also displayed on the welcome page) from admin end, with $services 
    // variable that fetch the ID from the specific column on front_services page from DB.
    public function render()
    {
        $services = Front_Service::find($this->service_id);
        return view('livewire.admin.front-service.edit', compact('services'));
    }

    public function update() // The update front_service function.
    {
        // This validate the required input from the add front_services page
        $this->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'image' => 'required|mimes:svg',
        ]);

        // Update the datas here with the image in the public.services folder
        $image = $this->image->store('services', 'public');

        $services = Front_Service::find($this->service_id);
        $services->name = $this->name;
        $services->description = $this->description;
        $services->image = $image;
        $services->save();

        session()->flash('success','Service Modified Successfully!'); // session alert here
    }
}