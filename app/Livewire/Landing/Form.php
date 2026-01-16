<?php

namespace App\Livewire\Landing;

use App\Livewire\Forms\LandingForm;
use App\Mail\EcommerceContactFromLanding;
use App\Models\Sector;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Form extends Component
{
    public LandingForm $form;

    public bool $sended = false;

    public function save()
    {
        $this->form->validate();

        Mail::to(env('SC_MAIL_CONTACT'))->send(new EcommerceContactFromLanding($this->form));

        $this->sended = true;
    }

    public function render()
    {
        return view('livewire.landing.form', [
            'sectors' => Sector::orderBy('name')->get()
        ]);
    }
}
