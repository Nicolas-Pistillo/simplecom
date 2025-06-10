<?php

namespace App\Livewire\Admin\Dashboard;

use App\Enums\PeriodOption;
use Livewire\Component;

class Graphics extends Component
{
    protected $listeners = ['period-updated' => 'updatePeriod'];

    public PeriodOption $period = PeriodOption::ThisWeek;

    public function updatePeriod(PeriodOption $period)
    {
        $this->period = $period;
    }

    public function getOrderEvolution()
    {
        return [
            random_int(199, 899),
            random_int(199, 899),
            random_int(199, 899),
            random_int(199, 899),
            random_int(199, 899),
            random_int(199, 899),
            random_int(199, 899),
            random_int(199, 899)
        ];
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

    public function render()
    {
        return view('livewire.admin.dashboard.graphics');
    }
}
