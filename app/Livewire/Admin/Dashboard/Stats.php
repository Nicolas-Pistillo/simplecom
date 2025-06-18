<?php

namespace App\Livewire\Admin\Dashboard;

use App\Enums\PeriodOption;
use App\Models\Order;
use Livewire\Component;

class Stats extends Component
{
    public PeriodOption $period = PeriodOption::ThisWeek;

    public function setPeriod(PeriodOption $period)
    {
        $this->period = $period;

        $this->dispatch('period-updated', $period);
    }

    public function getOrderAverage()
    {
        $orders = Order::byPeriod($this->period);

        $totalCount = $orders->count();

        if (empty($totalCount)) return ['total' => 0, 'conversionRate' => 0];

        $conversionRate = round(($orders->paid()->count() / $totalCount) * 100, 2);

        return [
            'total'          => $totalCount,
            'conversionRate' => $conversionRate
        ];
    }

    public function getTotalSold()
    {
        $orders = Order::byPeriod($this->period)->paid();

        return [
            'total'         => $orders->sum('total'),
            'totalShipping' => $orders->sum('shipping_cost')
        ];
    }

    public function getAverageTicket()
    {
        $orders = Order::byPeriod($this->period)->paid();

        $totalCount = $orders->count();

        if (empty($totalCount)) return 0;

        return $orders->sum('total') / $totalCount;
    }

    public function render()
    {
        return view('livewire.admin.dashboard.stats', [
            'orderAverage'       => $this->getOrderAverage(),
            'totalSold'          => $this->getTotalSold(),
            'averageTicket'      => $this->getAverageTicket()
        ]);
    }
}
