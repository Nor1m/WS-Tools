<?php

if(!function_exists('toolSettings')) {
    function toolSettings(string $tool, string $key = null, mixed $default = null): mixed
    {
        $key = $key ? ".{$key}" : "";
        return toolsSettings("tools.{$tool}{$key}", $default);
    }
}

if(!function_exists('toolsSettings')) {
    function toolsSettings(string $key = null, mixed $default = null): mixed
    {
        $key = $key ? ".{$key}" : "";
        return config("tools_settings{$key}", $default);
    }
}

if(!function_exists('getHttpTextByCode')) {
    function getHttpTextByCode(int $code, mixed $default = null): ?string
    {
        return config('http_codes.'.$code, $default);
    }
}

if(!function_exists('getTimeStatusInfo')) {
    function getTimeStatusInfo(int $time): array
    {
        if ($time > config('tools_settings.time.very_slow')) {
            $statusClass = 'slow';
            $statusText = __('time.very_slow');
        } elseif ($time > config('tool_settings.time.slow')) {
            $statusClass = 'slow';
            $statusText = __('time.slow');
        } elseif ($time > config('tool_settings.time.normal')) {
            $statusClass = 'medium';
            $statusText = __('time.normal');
        } elseif ($time > config('tool_settings.time.fast')) {
            $statusClass = 'fast';
            $statusText = __('time.fast');
        } else {
            $statusClass = 'fast';
            $statusText = __('time.very_fast');
        }

        return ['statusClass' => $statusClass, 'statusText' => $statusText];
    }
}