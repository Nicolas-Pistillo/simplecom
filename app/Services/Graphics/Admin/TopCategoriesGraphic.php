<?php

namespace App\Services\Graphics\Admin;

use App\Enums\PeriodOption;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;

class TopCategoriesGraphic extends BaseGraphic
{
    public function generate()
    {
        if ($this->period === PeriodOption::Historic) 
        {
            $items = OrderItem::with('category')
                        ->whereHas('order', fn($query) => $query->paid())
                        ->get()
                        ->groupBy(fn($item) => $item->category->name)
                        ->map->sum('quantity')
                        ->sortDesc()
                        ->take(5);

            $chartData = [
                'labels' => [],
                'data'   => []
            ];

            foreach ($items as $category => $count) {
                $chartData['labels'][] = $category;
                $chartData['data'][] = $count;
            }

            return $chartData;
        }

        if ($this->period === PeriodOption::Today) 
        {
            $items = OrderItem::with('category')
                        ->whereDate('created_at', Carbon::today())
                        ->whereHas('order', fn($query) => $query->paid())
                        ->get()
                        ->groupBy(fn($item) => $item->category->name)
                        ->map->sum('quantity')
                        ->sortDesc()
                        ->take(5);

            $chartData = [
                'labels' => [],
                'data'   => []
            ];

            foreach ($items as $category => $count) {
                $chartData['labels'][] = $category;
                $chartData['data'][] = $count;
            }

            return $chartData;
        }

        if ($this->period === PeriodOption::ThisWeek || $this->period === PeriodOption::LastWeek) 
        {
            $startOfWeek = $this->period === PeriodOption::ThisWeek
                ? Carbon::now()->startOfWeek()
                : Carbon::now()->subWeek()->startOfWeek();

            $endOfWeek = $this->period === PeriodOption::ThisWeek
                ? Carbon::now()->endOfWeek()
                : Carbon::now()->subWeek()->endOfWeek();

            $items = OrderItem::with('category')
                        ->whereHas('order', fn($query) => $query->paid())
                        ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                        ->get()
                        ->groupBy(fn($item) => $item->category->name)
                        ->map->sum('quantity')
                        ->sortDesc()
                        ->take(5);

            $chartData = [
                'labels' => [],
                'data'   => []
            ];

            foreach ($items as $category => $count) {
                $chartData['labels'][] = $category;
                $chartData['data'][] = $count;
            }

            return $chartData;
        }

        if ($this->period === PeriodOption::ThisMonth || $this->period === PeriodOption::LastMonth) 
        {
            $startOfMonth = $this->period === PeriodOption::ThisMonth
                ? Carbon::now()->startOfMonth()
                : Carbon::now()->subMonth()->startOfMonth();

            $endOfMonth = $this->period === PeriodOption::ThisMonth
                ? Carbon::now()->endOfMonth()
                : Carbon::now()->subMonth()->endOfMonth();

            $items = OrderItem::with('category')
                        ->whereHas('order', fn($query) => $query->paid())
                        ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                        ->get()
                        ->groupBy(fn($item) => $item->category->name)
                        ->map->sum('quantity')
                        ->sortDesc()
                        ->take(5);

            $chartData = [
                'labels' => [],
                'data'   => []
            ];

            foreach ($items as $category => $count) {
                $chartData['labels'][] = $category;
                $chartData['data'][] = $count;
            }

            return $chartData;
        }
    }
}