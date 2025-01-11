<?php

namespace App\Services\Utils;

class UrlService
{
    /**
     * @param $url
     * @return bool
     */
    public static function checkServerAvailability($url): bool
    {
        return is_array(@get_headers($url));
    }
}