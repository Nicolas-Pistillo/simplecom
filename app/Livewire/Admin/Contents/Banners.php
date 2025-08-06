<?php

namespace App\Livewire\Admin\Contents;

use App\Livewire\Forms\BannerForm;
use App\Models\Banner;
use App\Traits\Livewire\WithNotifications;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Banners extends Component
{
    use WithFileUploads;
    use WithNotifications;

    public BannerForm $form;

    public function messages()
    {
        return [
            'image.max' => 'La imagen no puede pesar más de 4MB'
        ];
    }

    public function updatedFormImage()
    {
        if($this->form->image->getSize() >= 4000000)
        {
            $this->form->image = null;
            return $this->form->imagePreview = null;
        }

        $this->form->imagePreview = $this->form->image->temporaryUrl();
    }

    public function deleteImage()
    {
        $this->form->reset('image', 'imagePreview');
    }

    public function openNewBanner()
    {
        $this->form->reset();
        $this->dispatch('open-drawer');
    }

    public function openEditBanner(Banner $banner)
    {
        $this->form->reset();

        $this->form->fill([
            'banner'       => $banner,
            'drawerTitle'  => "Editando $banner->name",
            'published'    => boolval($banner->published),
            'name'         => $banner->name,
            'link'         => $banner->link,
            'imagePreview' => Storage::url($banner->image_url)
        ]);

        $this->dispatch('open-drawer');
    }

    public function togglePublishedBanner(Banner $banner)
    {
        $banner->update(['published' => !$banner->published]);

        $actionTitle = $banner->published ? 'Publicaste' : 'Despublicaste';

        $this->notify([
            'type'  => 'success',
            'title' => "$actionTitle este banner"
        ]);
    }

    public function cancelForm()
    {
        $this->dispatch('close-drawer');
    }

    public function save()
    {
        $this->form->banner ? $this->updateBanner() : $this->createBanner();
        $this->dispatch('close-drawer');
    }

    public function updateBanner()
    {
        if ($this->form->name != $this->form->banner->name) 
            $this->validateOnly('name');

        $this->form->banner->update([
            'name'      => $this->form->name,
            'link'      => $this->form->link,
            'published' => $this->form->published
        ]);

        if ($this->form->image)
        {
            Storage::delete($this->form->banner->image_url);
            $path = $this->form->image->store(tenant('banners_url'));

            $this->form->banner->update(['image_url' => $path]);
        }

        Log::channel('resources')->info('Banner actualizado', [
            'tenant'      => tenant('name'),
            'operator_id' => Auth::id(),
            'banner'      => $this->form->banner
        ]);

        $this->notify([
            'type'  => 'success',
            'title' => "Banner actualizado con éxito"
        ]);
    }

    public function createBanner()
    {
        $this->form->validate();

        $name = !empty($this->form->name) ? trim($this->form->name) : 'Banner sin nombre';

        $banner = Banner::create([
            'name'      => $name,
            'image_url' => $this->form->image->store(tenant('banners_url')),
            'link'      => $this->form->link,
            'published' => $this->form->published
        ]);

        Log::channel('resources')->info('Nuevo banner', [
            'tenant'      => tenant('name'),
            'operator_id' => Auth::id(),
            'banner'      => $banner
        ]);

        $this->notify([
            'type'  => 'success',
            'title' => "Banner creado con éxito"
        ]);
    }

    public function deleteBanner(Banner $banner)
    {
        Storage::delete($banner->image_url);
        $banner->delete();

        $this->notify([
            'type'  => 'success',
            'title' => "Banner eliminado con éxito"
        ]);
    }

    public function render()
    {
        return view('livewire.admin.contents.banners', [
            'banners' => Banner::all()
        ]);
    }
}
