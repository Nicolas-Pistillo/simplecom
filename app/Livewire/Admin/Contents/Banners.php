<?php

namespace App\Livewire\Admin\Contents;

use App\Models\Banner;
use Illuminate\Support\Facades\Http;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Banners extends Component
{
    use WithFileUploads;

    #[Validate('required|image|max:4024', as: 'imagen')]
    public $image;

    #[Validate('required|string|max:40|unique:banners,name', as: 'nombre')]
    public $name;

    public $published = false;
    public $drawerTitle, $imagePreview, $notificationMessage;

    public function messages()
    {
        return [
            'image.max' => 'La imagen no puede pesar más de 4MB'
        ];
    }

    public function updatedImage()
    {
        $this->validateOnly('image');
        $this->imagePreview = $this->image->temporaryUrl();
    }

    public function deleteImage()
    {
        $this->reset('image', 'imagePreview');
    }

    public function openNewBanner()
    {
        $this->reset('drawerTitle', 'published', 'name', 'image', 'imagePreview');

        $this->drawerTitle = "Nuevo Banner";
        $this->dispatch('open-drawer');
    }

    public function cancelForm()
    {
        $this->dispatch('close-drawer');
    }

    public function notify($message)
    {
        $this->notificationMessage = $message;
        $this->dispatch('open-notification');
    }

    public function save()
    {
        $this->validate();

        $path = $this->image->store(tenant('banners_url'));

        Banner::create([
            'name' => $this->name,
            'image_url' => $path,
            'published' => $this->published
        ]);

        $this->notify("Banner creado con éxito");
        $this->dispatch('close-drawer');
    }

    public function render()
    {
        return view('livewire.admin.contents.banners');
    }
}
