<?php

namespace App\Livewire\Admin\Orders;

use App\Exports\OrdersExport;
use App\Livewire\Forms\IndexOrdersFilters;
use App\Models\Order;
use App\Traits\Livewire\WithNotifications;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    use WithPagination, WithNotifications;

    public $search = '';

    public $selected_orders = [];

    public bool $has_orders;

    public IndexOrdersFilters $filters;

    public function updatedSearch()
    {
        $this->selected_orders = [];
        $this->setPage(1);
    }

    public function updatedFilters()
    {
        $this->selected_orders = [];
        $this->setPage(1);
    }

    public function download($selecteds = false)
    {
        $orders = $selecteds 
                    ? Order::find($this->selected_orders)
                    : Order::all();

        $date = date('d-m-Y');

        return Excel::download(new OrdersExport($orders), "pedidos-$date.xlsx");
    }

    public function toggleSelectedOrder($orderId)
    {
        in_array($orderId, $this->selected_orders)
            ? array_splice($this->selected_orders, array_search($orderId, $this->selected_orders), 1)
            : array_push($this->selected_orders, $orderId);
    }

    public function getOrders()
    {
        return Order::with('user', 'paymentMethod')
                    ->adminSearch($this->search)
                    ->adminFilter($this->filters)
                    ->orderBy('created_at', 'DESC')
                    ->paginate(15);
    }

    public function mount()
    {
        $this->has_orders = Order::count() > 0;
    }

    public function removeFilter($filter)
    {
        $this->filters->reset($filter);
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->filters->reset();
    }

    public function render()
    {
        return view('livewire.admin.orders.index', [
            'orders'     => $this->getOrders(),
            'hasFilters' => $this->filters->isNotEmpty()
        ]);
    }
}
