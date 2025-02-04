<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

class FileService
{
    public static function getUploadedFileFromUrl($url): UploadedFile|false
    {
        $url = stripslashes($url);
        $url = str_replace(['[', ']', '"'], '', $url);

        try 
        {
            $info = pathinfo($url);
            $content = file_get_contents($url);

        } catch (\Throwable $err) 
        {
            return false;
        }

        $file = '/tmp/' . $info['basename'];

        file_put_contents($file, $content);

       return new UploadedFile($file, $info['basename']);
    }
}
