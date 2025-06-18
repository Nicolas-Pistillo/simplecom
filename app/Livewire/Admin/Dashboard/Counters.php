<?php

namespace App\Livewire\Admin\Dashboard;

use Livewire\Component;
use App\Enums\InvoiceStatus;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;

class Counters extends Component
{
    public function getTotalInvoices()
    {
        return Invoice::where('status', InvoiceStatus::Issued)->count();
    }

    public function getTotalProducts()
    {
        $products = Product::query();

        return [
            'total'          => $products->count(),
            'totalPublished' => $products->available()->count()
        ];
    }

    public function getTotalCustomers()
    {
        $customers = User::query();

        return [
            'total'           => $customers->count(),
            'totalRegistered' => $customers->registered()->count()
        ];
    }

    public function render()
    {
        return view('livewire.admin.dashboard.counters', [
            'totalInvoices'      => $this->getTotalInvoices(),
            'totalProducts'      => $this->getTotalProducts(),
            'totalCustomers'     => $this->getTotalCustomers()
        ]);
    }
}
