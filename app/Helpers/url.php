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

if(!function_exists('punycodeEncode')) {
    function punycodeEncode(string $url): string
    {
        $url = addProtocolIfNotExists($url);
        $parts = parse_url($url);
        $returnUrl = '';
        if (!empty($parts['scheme'])) 
            $returnUrl .= $parts['scheme'] . ':';
        if (!empty($parts['host'])) 
            $returnUrl .= '//';
        if (!empty($parts['user'])) 
            $returnUrl .= $parts['user'];
        if (!empty($parts['pass'])) 
            $returnUrl .= ':' . $parts['pass'];
        if (!empty($parts['user'])) 
            $returnUrl .= '@';
        if (!empty($parts['host'])) 
            $returnUrl .= idn_to_ascii($parts['host']);
        if (!empty($parts['port'])) 
            $returnUrl .= ':' . $parts['port'];
        if (!empty($parts['path'])) 
            $returnUrl .= $parts['path'];
        if (!empty($parts['query'])) 
            $returnUrl .= '?' . $parts['query'];
        if (!empty($parts['fragment'])) 
            $returnUrl .= '#' . $parts['fragment'];

        return $returnUrl;
    }
}