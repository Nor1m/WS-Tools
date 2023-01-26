<?php

if(!function_exists('addProtocolIfNotExists')) {
    function addProtocolIfNotExists(string $url, string $protocol = 'http://'): string
    {
        if (parse_url($url, PHP_URL_SCHEME) === null) {
            $url = $protocol . $url;
        }

        return $url;
    }
}