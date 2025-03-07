<?php

namespace App\Livewire\Admin\Orders;

use App\Livewire\Forms\IndexOrdersFilters;
use App\Models\Order;
use App\Traits\Livewire\WithNotifications;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithNotifications;

    public $search = '';

    public $selectedOrders = [];

    public IndexOrdersFilters $filters;

    public function updatedSearch()
    {
        $this->selectedOrders = [];
        $this->setPage(1);
    }

    public function updatedFilters()
    {
        $this->selectedOrders = [];
        $this->setPage(1);
    }

    public function getOrders()
    {
        return Order::with('user', 'paymentMethod')
                    ->adminSearch($this->search)
                    ->adminFilter($this->filters)
                    ->orderBy('created_at', 'DESC')
                    ->paginate(15);
    }

    public function render()
    {
        return view('livewire.admin.orders.index', [
            'orders' => $this->getOrders()
        ]);
    }
}
