<?php

namespace App\Livewire\Ecommerce;

use App\Livewire\Forms\CheckoutForm;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class DropoffPointSelector extends Component
{
    public CheckoutForm $form;

    public $search;

    public function confirm($rateKey, $branchId)
    {
        try 
        {
            $rate = session('rates_results.dropoff_rates')->where('key', $rateKey)->first();
            $branch = $rate->branches->where('external_id', $branchId)->first();        

            session()->put('selected_rate_key', $rate);
            session()->put('selected_branch_id', $branch);

            $this->dispatch('selected-dropoff-point', rate: $rate, branch: $branch);

        } catch (\Throwable $err) 
        {
            Log::channel('error')->info('Error al confirmar punto dropoff', [
                'tenant'  => tenant('name'),
                'error'   => $err->getMessage(),
                'session' => session()->all()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.ecommerce.dropoff-point-selector');
    }
}
