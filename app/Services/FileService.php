<?php


namespace App\Services;


class FileService
{
    public static function processFile($value, $folder)
    {
        return is_string($value) || is_null($value) ? $value : str_replace('public', '', asset('storage' . $value->store('public/' . $folder)));
    }
}
