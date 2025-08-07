<?php

namespace App\Livewire\Admin\Contents;

use App\Models\Configuration;
use App\Traits\Livewire\WithNotifications;
use Livewire\Component;

class PromotionalMessage extends Component
{
    use WithNotifications;

    public $message;

    public function mount()
    {
        $this->message = tenant()->configValue('promotional_message');
    }

    public function delete()
    {
        Configuration::where('key', 'promotional_message')->update(['value' => null]);

        $this->reset('message');

        $this->notify([
            'type'  => 'success',
            'title' => 'Cambios guardados',
            'body'  => 'Eliminaste el mensaje promocional'
        ]);
    }

    public function save()
    {
        Configuration::where('key', 'promotional_message')->update(['value' => $this->message]);

        $this->notify([
            'type'  => 'success',
            'title' => 'Cambios guardados',
            'body'  => 'Actualizaste el mensaje promocional'
        ]);
    }

    public function render()
    {
        return view('livewire.admin.contents.promotional-message');
    }
}
