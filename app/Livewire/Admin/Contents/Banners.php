<?php

namespace App\Livewire\Admin\Contents;

use App\Models\Banner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
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
    public $banner, $drawerTitle, $imagePreview, $notificationMessage;

    public function messages()
    {
        return [
            'image.max' => 'La imagen no puede pesar más de 4MB'
        ];
    }

    public function updatedImage()
    {
        if($this->image->getSize() >= 4000000)
        {
            return $this->image = null;
        }

        $this->imagePreview = $this->image->temporaryUrl();
    }

    public function deleteImage()
    {
        $this->reset('image', 'imagePreview');
    }

    public function openNewBanner()
    {
        $this->reset('drawerTitle', 'banner', 'published', 'name', 'image', 'imagePreview');

        $this->drawerTitle = "Nuevo Banner";
        $this->dispatch('open-drawer');
    }

    public function openEditBanner(Banner $banner)
    {
        $this->reset('drawerTitle', 'banner', 'published', 'name', 'image', 'imagePreview');

        $this->fill([
            'banner'       => $banner,
            'drawerTitle'  => "Editando $banner->name",
            'published'    => boolval($banner->published),
            'name'         => $banner->name,
            'imagePreview' => Storage::url($banner->image_url)
        ]);

        $this->dispatch('open-drawer');
    }

    public function togglePublishedBanner(Banner $banner)
    {
        $banner->update(['published' => !$banner->published]);

        $actionTitle = $banner->published ? 'Publicaste' : 'Despublicaste';
        $this->notify("$actionTitle este banner");
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
        $this->banner ? $this->updateBanner() : $this->createBanner();
        $this->dispatch('close-drawer');
    }

    public function updateBanner()
    {
        if ($this->name != $this->banner->name) 
            $this->validateOnly('name');

        $this->banner->update([
            'name' => $this->name,
            'published' => $this->published
        ]);

        if ($this->image)
        {
            Storage::delete($this->banner->image_url);
            $path = $this->image->store(tenant('banners_url'));

            $this->banner->update(['image_url' => $path]);
        }

        Log::channel('resources')->info('Banner actualizado', [
            'tenant'      => tenant('name'),
            'operator_id' => Auth::id(),
            'banner'      => $this->banner
        ]);

        $this->notify("Banner actualizado con éxito");        
    }

    public function createBanner()
    {
        $this->validate();

        $path = $this->image->store(tenant('banners_url'));

        $banner = Banner::create([
            'name'      => $this->name,
            'image_url' => $path,
            'published' => $this->published
        ]);

        Log::channel('resources')->info('Nuevo banner', [
            'tenant'      => tenant('name'),
            'operator_id' => Auth::id(),
            'banner'      => $banner
        ]);

        $this->notify("Banner creado con éxito");
    }

    public function deleteBanner(Banner $banner)
    {
        Storage::delete($banner->image_url);
        $banner->delete();

        $this->notify("Banner eliminado con éxito");
    }

    public function render()
    {
        return view('livewire.admin.contents.banners', [
            'banners' => Banner::orderBy('order')->get()
        ]);
    }
}
