<?php

namespace App\Livewire\Admin\Contents;

use App\Livewire\Forms\FaqsForm;
use App\Models\Faq;
use App\Traits\Livewire\WithNotifications;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Faqs extends Component
{
    use WithNotifications;

    public FaqsForm $form;

    public function openNew()
    {
        $this->form->reset();
        $this->form->published = true;

        $this->dispatch('open-faqs-panel');
    }

    public function openEdit(Faq $faq)
    {
        $this->form->reset();

        $this->form->fill([
            'faq'       => $faq,
            'question'  => $faq->question,
            'response'  => $faq->response,
            'published' => boolval($faq->published)
        ]);

        $this->dispatch('open-faqs-panel');
    }

    public function togglePublished(Faq $faq)
    {
        $faq->update(['published' => !$faq->published]);

        $action = $faq->published ? 'Publicaste' : 'Despublicaste';

        $this->notify([
            'type'  => 'success',
            'title' => 'Pregunta actualizada',
            'body'  => "$action esta pregunta"
        ]);
    }

    public function save()
    {
        $this->form->validate();

        if ($this->form->faq instanceof Faq)
        {
            $this->form->faq->update([
                'question'  => $this->form->question,
                'response'  => $this->form->response,
                'published' => $this->form->published
            ]);

            $this->notify([
                'type'  => 'success',
                'title' => 'Pregunta actualizada',
                'body'  => 'guardaste correctamente los cambios'
            ]);

            return $this->dispatch('close-faqs-panel');
        }

        Faq::create([
            'question'   => $this->form->question,
            'response'   => $this->form->response,
            'published'  => $this->form->published,
            'created_by' => Auth::id()
        ]);

        $this->notify([
            'type'  => 'success',
            'title' => 'Pregunta creada',
            'body'  => 'guardaste correctamente los cambios'
        ]);

        return $this->dispatch('close-faqs-panel');
    }

    public function render()
    {
        return view('livewire.admin.contents.faqs', [
            'faqs' => Faq::all()
        ]);
    }
}
