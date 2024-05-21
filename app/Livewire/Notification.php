<?php

namespace App\Livewire;

use Livewire\Component;

class Notification extends Component
{
    public $type, $title, $body, $position, $time;

    protected $listeners = ['notification' => 'handleNotificationData'];

    public function handleNotificationData($data = [])
    {
        $this->fill([
            'type'     => $data['type']      ?? null,
            'title'    => $data['title']     ?? null,
            'body'     => $data['body']      ?? null,
            'position' => $data['position']  ?? null,
            'time'     => $data['time']      ?? null
        ]);

        $this->dispatch('open-notification');
    }

    public function render()
    {
        return view('livewire.notification');
    }
}
