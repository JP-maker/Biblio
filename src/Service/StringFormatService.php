<?php

namespace App\Service;

class StringFormatService
{
    // Preparing a string for query search
    public function prepareStrForSearch(string $str): string
    {
        return str_replace(' ', '%',strtoupper($str));
    }

}