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

    public function clearFilters()
    {
        $this->search = '';
        $this->filters->reset();
    }

    public function removeFilter($filter)
    {
        $this->filters->reset($filter);
    }

    public function bulkSetRead()
    {
        Message::whereIn('id', $this->selected_messages)->update(['read' => true]);

        $this->selected_messages = [];

        $this->notify([
            'type'  => 'success',
            'title' => 'Operacion exitosa',
            'body'  => 'Mensajes marcados como leídos'
        ]);
    }

    public function bulkSetUnread()
    {
        Message::whereIn('id', $this->selected_messages)->update(['read' => false]);

        $this->selected_messages = [];

        $this->notify([
            'type'  => 'success',
            'title' => 'Operacion exitosa',
            'body'  => 'Mensajes marcados como no leídos'
        ]);
    }

    public function bulkDelete()
    {
        Message::whereIn('id', $this->selected_messages)->delete();

        $this->selected_messages = [];

        $this->notify([
            'type'  => 'success',
            'title' => 'Operacion exitosa',
            'body'  => 'Mensajes eliminados correctamente'
        ]);
    }

    public function mount()
    {
        $this->has_messages = Message::count() > 0;
    }

    public function render()
    {
        return view('livewire.admin.messages.index', [
            'messages'   => $this->getMessages(),
            'hasFilters' => $this->filters->isNotEmpty(),
        ]);
    }
}
