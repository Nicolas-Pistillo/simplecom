<?php 

if (!function_exists('formatBytes'))
{
    function formatBytes($bytes, $precision = 2) { 
        $base = log($bytes, 1024);
        $suffixes = array('', 'KB', 'MB', 'GB', 'TB');   

        return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
    } 
}