<?php

use Illuminate\Support\Facades\Http;

if (!function_exists('formatBytes'))
{
    function formatBytes($bytes, $precision = 2) { 
        $base = log($bytes, 1024);
        $suffixes = array('', 'KB', 'MB', 'GB', 'TB');   

        return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
    } 
}

if(!function_exists('priceFormat'))
{
    function priceFormat($price)
    {
        return number_format($price, 0, '.', '.');
    }
}

if (!function_exists('geocodeZip'))
{
    function postalCodeInfo($postalCode)
    {
        return Http::get("https://geocodes.envia.com/zipcode/AR/1890");
    }
}