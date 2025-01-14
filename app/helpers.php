<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
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
        return number_format($price, 0, ',', '.');
    }
}

if (!function_exists('zipcodeInfo'))
{
    function zipcodeInfo($zipCode)
    {
        return Http::get("https://geocodes.envia.com/zipcode/AR/$zipCode")->json();
    }
}

if (!function_exists('cityInfo'))
{
    function cityInfo($city)
    {
        return Http::get("https://geocodes.envia.com/locate/AR/$city")->json();
    }
}

if (!function_exists('initialsAvatar'))
{
    function initialsAvatar($options = [])
    {
        if (empty($options) && Auth::check())
        {
            $fullName = Auth::user()->full_name;
            return "https://ui-avatars.com/api/?name=$fullName&bold=true&background=fff&color=000";  
        }

        $query = http_build_query($options);
        return "https://ui-avatars.com/api/?$query";
    }
}