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
    function priceFormat($price, $decimals = 0)
    {
        return number_format($price, $decimals, '.', '.');
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

if (!function_exists('originPointsRoute'))
{
    function originPointsRoute()
    {
        return route('admin.delivery-methods.index', [
            'tab'           => 'Proveedores', 
            'providers-tab' => 'Puntos de origen'
        ]);
    }
}

if (!function_exists('validateCuit'))
{
    function validateCuit($cuit)
	{
		$len = strlen((string) $cuit);

        if ( $len == 13 ) {
            $nro = (string) $cuit;

            if ($nro[2] != '-' || $nro[11] != '-') 
            {
                return false;
            } else {
                $nro = str_replace( '-', '', $nro );
            }
        } elseif ($len == 11) {
            $nro = (string)$cuit;
        } else {
            return false;
        }

        $base = [5, 4, 3, 2, 7, 6, 5, 4, 3, 2];

        $aux = 0;

        for ($i = 0; $i < 10; $i++) 
        {
            $aux += $base[$i] * (int)$nro[$i];
        }

        $verif = 11 - ($aux % 11);

        if ($verif == 11) 
        {
            $verif = 0;
        } elseif ($verif == 10) {
            // nunca debería dar 10 porque, en ese caso, se tiene que recalcular
            // cambiando el prefijo (si es un CUIT bien formado, no debería dar
            // 10, aunque tengo dudas en como se recalculan los CUIT repetidos,
            // los cuales pueden tener prefijos 24, 25, 26, 27 y 34)
            return false;
        }
        return $nro[10] == (string) $verif;
	}
}

if (!function_exists('getDateName'))
{
    function getDateName(DateTime $date)
    {
        $monthNames = [
            'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo',
            'Junio', 'Julio', 'Agosto', 'Septiembre',
            'Octubre', 'Noviembre', 'Diciembre'
        ];

        if (now()->diffInMinutes($date) < 2)
            return "Ahora";

        if (now()->diffInMinutes($date) < 60)
            return "Hace " . now()->diffInMinutes($date) . ' minutos';

        if ($date->isToday())
            return "Hoy";

        if ($date->isYesterday())
            return "Ayer";

        if (now()->year > $date->year)
            return $date->format('d/m/Y');

        return $date->day . ' de ' . data_get($monthNames, $date->month);
    }
}