<?php

namespace Tests\Hooks;

use PHPUnit\Runner\AfterLastTestHook;
use PHPUnit\Runner\BeforeFirstTestHook;
use PHPUnit\Runner\BeforeTestHook;

class Hooks implements BeforeFirstTestHook, AfterLastTestHook, BeforeTestHook
{
    public function executeBeforeFirstTest(): void
    {
        $this->clearCache();
    }

    public function executeBeforeTest(string $test): void
    {
    }

    public function executeAfterLastTest(): void
    {
    }

    private function clearCache(): void
    {
        exec("php artisan config:clear");
        exec("php artisan cache:clear");
        exec("php artisan view:clear");
        exec("php artisan route:clear");
    }
}