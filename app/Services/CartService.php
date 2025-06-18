<?php

namespace App\Services;

use Gloudemans\Shoppingcart\Facades\Cart;

class CartService
{
    /**
     * Calculates the current cart package dimensions and the declared value
     */
    public static function getPackageInfo(): array|false
    {
        if (empty(Cart::content())) return false;

        $content = Cart::content();

        $declaredValue = floatval($content->sum(fn($item) => $item->model->price * $item->qty));
        $height = floatval($content->sum(fn($item) => $item->model->height * $item->qty));
        $weight = floatval($content->sum(fn($item) => ($item->model->weight / 1000) * $item->qty));
        $width  = 0;
        $length = 0;

        foreach($content as $item)
        {
            $width = floatval($item->model->width) > $width 
                        ? floatval($item->model->width) 
                        : $width;

            $length = floatval($item->model->length) > $length 
                        ? floatval($item->model->length) 
                        : $length;
        }

        $package = [
            'items' => $content->sum('qty'),
            'weight' => $weight,
            'declaredValue' => $declaredValue,
            'dimensions' => [
                'width'  => $width,
                'height' => $height,
                'length' => $length,
                'volume' => $width * $height * $length
            ]
        ];

        return $package;
    }
}