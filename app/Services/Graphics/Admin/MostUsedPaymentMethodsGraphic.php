<?php

namespace App\Services\Graphics\Admin;

use App\Enums\PeriodOption;
use App\Models\Order;
use Carbon\Carbon;

class MostUsedPaymentMethodsGraphic extends BaseGraphic
{
    public function generate()
    {
        if ($this->period === PeriodOption::Historic) 
        {
            $orders = Order::with('paymentMethod')
                ->paid()
                ->get()
                ->groupBy(function ($order) {
                    return $order->paymentMethod->display_name;
                })
                ->map->count();

            $chartData = [
                'labels' => [],
                'data'   => []
            ];

            foreach ($orders as $method => $ordersCount) {
                $chartData['labels'][] = $method;
                $chartData['data'][] = $ordersCount;
            }

            return $chartData;
        }

        if ($this->period === PeriodOption::Today) 
        {
            $orders = Order::with('paymentMethod')
                ->paid()
                ->whereDate('created_at', Carbon::today())
                ->get()
                ->groupBy(function ($order) {
                    return $order->paymentMethod->display_name;
                })
                ->map->count();

            $chartData = [
                'labels' => [],
                'data'   => []
            ];

            foreach ($orders as $method => $ordersCount) {
                $chartData['labels'][] = $method;
                $chartData['data'][] = $ordersCount;
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

            $orders = Order::with('paymentMethod')
                ->paid()
                ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
                ->get()
                ->groupBy(function ($order) {
                    return $order->paymentMethod->display_name;
                })
                ->map->count();

            $chartData = [
                'labels' => [],
                'data'   => []
            ];

            foreach ($orders as $method => $ordersCount) {
                $chartData['labels'][] = $method;
                $chartData['data'][] = $ordersCount;
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

            $orders = Order::with('paymentMethod')
                ->paid()
                ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
                ->get()
                ->groupBy(function ($order) {
                    return $order->paymentMethod->display_name;
                })
                ->map->count();

            $chartData = [
                'labels' => [],
                'data'   => []
            ];

            foreach ($orders as $method => $ordersCount) {
                $chartData['labels'][] = $method;
                $chartData['data'][] = $ordersCount;
            }

            return $chartData;
        }
    }
}
