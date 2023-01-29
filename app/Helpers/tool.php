<?php

if(!function_exists('toolSettings')) {
    function toolSettings(string $tool = null, string $key = null, mixed $default = null): mixed
    {
        $tool = $tool ? ".{$tool}" : "";
        $key = $key ? ".{$key}" : "";
        return config("tools_settings.tools{$tool}{$key}", $default);
    }
}