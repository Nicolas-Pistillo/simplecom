<?php

namespace App\Services;

use Gloudemans\Shoppingcart\Facades\Cart;

class CartService
{
    /**
     * Calculates the current cart package dimensions and the declared value
     */
    public static function getPackageInfo($weightUnit = 'gr'): array|false
    {
        if (empty(Cart::content())) return false;

        $package = [
            'declaredValue' => 0,
            'items' => Cart::count(),
            'dimensions' => [
                'width'  => 0,
                'height' => 0,
                'length' => 0,
                'volume' => 0,
                'weight' => 0
            ]
        ];

        foreach(Cart::content() as $item)
        {
            $price  = $item->model->price  * $item->qty;
            $weight = $item->model->weight * $item->qty;
            $width  = $item->model->width  * $item->qty;
            $height = $item->model->height * $item->qty;
            $length = $item->model->length * $item->qty;

            if ($weightUnit === 'kg')
            {
                $weight = $weight / 1000;
            }

            $package['declaredValue']        += $price;
            $package['dimensions']['weight'] += $weight;
            $package['dimensions']['width']  += $width;
            $package['dimensions']['height'] += $height;
            $package['dimensions']['length'] += $length;
            $package['dimensions']['volume'] += ($width * $height * $length);
        }

        return $package;
    }
}