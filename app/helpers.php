<?php

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

        $options['background'] = $options['background'] ?? '#2563eb';
        $options['color'] = $options['color'] ?? 'fff';

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

if (!function_exists('getElapsedTime'))
{
    function getElapsedTime(DateTime $date, $withHours = false)
    {
        $monthNames = [
            1  => 'Enero',
            2  => 'Febrero',
            3  => 'Marzo',
            4  => 'Abril',
            5  => 'Mayo',
            6  => 'Junio',
            7  => 'Julio',
            8  => 'Agosto',
            9  => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre'
        ];

        if (now()->diffInMinutes($date) < 2)
            return "Ahora";

        if (now()->diffInMinutes($date) < 60)
            return "Hace " . now()->diffInMinutes($date) . ' minutos';

        if (now()->diffInHours($date) < 24)
        {
            $difference = now()->diffInHours($date);
            return $difference === 1 ? 'Hace 1 hora' : "Hace $difference horas";
        }

        if ($date->isYesterday())
            return "Ayer";

        if (now()->year > $date->year)
            return $date->format('d/m/Y H:i');

        $output = $date->day . ' de ' . data_get($monthNames, $date->month);

        if ($withHours) $output .= ' ' . $date->format('H:i');

        return $output;
    }
}

if (!function_exists('getRawColor'))
{
    function getRawColor($color)
    {
        $colors = [
            'red'    => '#dc2626',
            'green'  => '#16a34a',
            'blue'   => '#2563eb',
            'yellow' => '#ca8a04',
            'cyan'   => '#0891b2',
            'gray'   => '#4b5563',
            'teal'   => '#0d9488',
            'sky'    => '#0ea5e9',
            'indigo' => '#4f46e5',
            'purple' => '#9333ea',
            'pink'   => '#db2777',
            'orange' => '#ea580c',
            'slate'  => '#475569',
            'lime'   => '#65a30d',
            'emerald'=> '#059669',
            'fuchsia'=> '#c026d3',
            'rose'   => '#e11d48',
            'violet' => '#7c3aed',
            'amber'  => '#d97706',
            'zinc'   => '#52525b',
            'stone'  => '#57534e',
        ];

        return data_get($colors, $color, '#4b5563');
    }
}

if (!function_exists('getRawLightedColor'))
{
    function getRawLightedColor($color)
    {
        $colors = [
            'red'    => 'rgba(239,68,68,0.05)',
            'green'  => 'rgba(34,197,94,0.05)',
            'blue'   => 'rgba(59,130,246,0.05)',
            'yellow' => 'rgba(234,179,8,0.05)',
            'cyan'   => 'rgba(6,182,212,0.05)',
            'gray'   => 'rgba(107,114,128,0.05)',
            'teal'   => 'rgba(20,184,166,0.05)',
            'sky'    => 'rgba(14,165,233,0.05)',
            'indigo' => 'rgba(99,102,241,0.05)',
            'purple' => 'rgba(168,85,247,0.05)',
            'pink'   => 'rgba(236,72,153,0.05)',
            'orange' => 'rgba(249,115,22,0.05)',
            'lime'   => 'rgba(132,204,22,0.05)',
            'emerald'=> 'rgba(16,185,129,0.05)',
            'fuchsia'=> 'rgb(217,70,239,0.05)',
            'rose'   => 'rgba(244,63,94,0.05)',
            'violet' => 'rgba(139,92,246,0.05)',
            'amber'  => 'rgba(245,158,11,0.05)',
            'slate'  => '#475569',
            'zinc'   => '#52525b',
            'stone'  => '#57534e',
        ];

        return data_get($colors, $color);
    }
}