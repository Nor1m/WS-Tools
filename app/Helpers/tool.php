<?php

if(!function_exists('toolSettings')) {
    function toolSettings(string $tool, string $key, mixed $default = null): mixed
    {
        return config("tools_settings.tools.{$tool}.{$key}", $default);
    }
}