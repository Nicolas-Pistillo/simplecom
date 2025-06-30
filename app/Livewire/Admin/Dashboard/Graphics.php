<?php

namespace App\Livewire\Admin\Dashboard;

use App\Enums\PeriodOption;
use App\Services\GraphicsService;
use Livewire\Component;

class Graphics extends Component
{
    protected $listeners = ['period-updated' => 'updatePeriod'];

    public PeriodOption $period = PeriodOption::ThisWeek;

    public function updatePeriod(PeriodOption $period)
    {
        $this->period = $period;
        $this->dispatch('update-graphics');
    }

    public function orderEvolution()
    {
        return GraphicsService::getOrderEvolution($this->period);
    }

    public function getUserRegistration()
    {
        return [
            random_int(199, 899),
            random_int(199, 899),
            random_int(199, 899),
            random_int(199, 899),
            random_int(199, 899),
            random_int(199, 899),
            random_int(199, 899)
        ];
    }

    public function getMostUsedPaymentMethods()
    {
        return [
            random_int(199, 899),
            random_int(199, 899),
            random_int(199, 899),
            random_int(199, 899),
            random_int(199, 899)
        ];
    }

    public function getBestSellingCategories()
    {
        return [
            random_int(199, 899),
            random_int(199, 899),
            random_int(199, 899),
            random_int(199, 899),
            random_int(199, 899)
        ];
    }

    public function mount()
    {
        $this->dispatch('update-graphics');
    }

    public function render()
    {
        return view('livewire.admin.dashboard.graphics');
    }
}
