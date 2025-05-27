<?php

namespace App\Livewire\Admin\Messages;

use App\Livewire\Forms\IndexMessagesFilters;
use App\Models\Message;
use App\Traits\Livewire\WithNotifications;
use Livewire\Component;

class Index extends Component
{
    use WithNotifications;

    public IndexMessagesFilters $filters;

    public $search = '';

    public bool $has_messages;

    public $selected_messages = [];

    public function getMessages()
    {
        return Message::adminSearch($this->search) 
                    ->adminFilter($this->filters)
                    ->orderBy('created_at', 'DESC')->get();
    }

    public function mount()
    {
        $this->has_messages = Message::count() > 0;
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->filters->reset();
    }

    public function render()
    {
        return view('livewire.admin.messages.index', [
            'messages' => $this->getMessages(),
        ]);
    }
}
