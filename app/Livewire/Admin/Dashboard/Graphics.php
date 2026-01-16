<?php

namespace App\Livewire\Admin\Dashboard;

use App\Enums\PeriodOption;
use App\Models\OrderItem;
use App\Models\Product;
use App\Services\Graphics\Admin\TopCategoriesGraphic;
use App\Services\Graphics\Admin\MostUsedPaymentMethodsGraphic;
use App\Services\Graphics\Admin\SalesEvolutionGraphic;
use App\Services\Graphics\Admin\UserRegistrationGraphic;
use Carbon\Carbon;
use Livewire\Component;

class Graphics extends Component
{
    protected $listeners = ['period-updated' => 'updatePeriod'];

    public PeriodOption $period = PeriodOption::Today;

    public function updatePeriod(PeriodOption $period)
    {
        $this->period = $period;
        $this->dispatch('update-graphics');
    }

    public function salesEvolution()
    {
        $graphic = new SalesEvolutionGraphic($this->period);

        return $graphic->generate();
    }

    public function userRegistration()
    {
        $graphic = new UserRegistrationGraphic($this->period);

        return $graphic->generate();
    }

    public function mostUsedPaymentMethods()
    {
        $graphic = new MostUsedPaymentMethodsGraphic($this->period);

        return $graphic->generate();
    }

    public function bestSellingCategories()
    {
        $graphic = new TopCategoriesGraphic($this->period);

        return $graphic->generate();
    }

    public function getTopProducts()
    {
        $items = OrderItem::whereHas('order', fn($query) => $query->paid());

        if ($this->period === PeriodOption::Today)
        {
            $items->whereDate('created_at', Carbon::today());
        }

        if ($this->period === PeriodOption::ThisWeek || $this->period === PeriodOption::LastWeek) 
        {
            $startOfWeek = $this->period === PeriodOption::ThisWeek
                ? Carbon::now()->startOfWeek()
                : Carbon::now()->subWeek()->startOfWeek();

            $endOfWeek = $this->period === PeriodOption::ThisWeek
                ? Carbon::now()->endOfWeek()
                : Carbon::now()->subWeek()->endOfWeek();

            $items->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
        }

        if ($this->period === PeriodOption::ThisMonth || $this->period === PeriodOption::LastMonth) 
        {
            $startOfMonth = $this->period === PeriodOption::ThisMonth
                ? Carbon::now()->startOfMonth()
                : Carbon::now()->subMonth()->startOfMonth();

            $endOfMonth = $this->period === PeriodOption::ThisMonth
                ? Carbon::now()->endOfMonth()
                : Carbon::now()->subMonth()->endOfMonth();

            $items->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
        }

        $items = $items->get()
                        ->groupBy(fn($item) => $item->product_id)
                        ->map->sum('quantity')
                        ->sortDesc()
                        ->take(5);

        $products = collect();

        foreach($items as $productId => $quantity)
        {
            $product = Product::with('category')->find($productId);

            if (!$product) continue;

            $product->total_sold = $quantity;

            $lastSale = OrderItem::whereHas('order', fn($query) => $query->paid())
                                ->where('product_id', $product->id)
                                ->latest()
                                ->first();

            $product->last_sale = $lastSale;

            $products->push($product);
        }

        return $products;
    }

    public function mount()
    {
        $this->dispatch('update-graphics');
    }

    public function render()
    {
        return view('livewire.admin.dashboard.graphics', [
            'topProducts' => $this->getTopProducts()
        ]);
    }
}
