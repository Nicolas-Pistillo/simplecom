<?php

namespace App\Livewire\Admin\Customers;

use App\Enums\CustomerType;
use App\Exports\CustomersExport;
use App\Livewire\Forms\IndexCustomersFilters;
use App\Models\User;
use App\Traits\Livewire\WithNotifications;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    use WithPagination, WithNotifications;

    public $search = '';

    public bool $has_customers;

    public IndexCustomersFilters $filters;

    public function updatedSearch()
    {
        $this->setPage(1);
    }

    public function updatedFilters($value, $key)
    {
        if ($key === 'only_guest' && $value) $this->filters->only_registered = false;
        if ($key === 'only_registered' && $value) $this->filters->only_guest = false;

        $this->setPage(1);
    }

    public function download()
    {
        $date = date('d-m-Y');
        return Excel::download(new CustomersExport(User::all()), "clientes-$date.xlsx");
    }

    public function getCustomers()
    {
        $users = User::search($this->search);

        if ($this->filters->only_guest) $users->where('type', CustomerType::Guest);
        if ($this->filters->only_registered) $users->where('type', CustomerType::Registered);

        return $users->paginate(10);
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

    public function mount()
    {
        $this->has_customers = User::count() > 0;
    }

    public function render()
    {
        return view('livewire.admin.customers.index', [
            'customers' => $this->getCustomers(),
            'hasFilters' => $this->filters->isNotEmpty()
        ]);
    }
}
