<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Mail;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function setUp(): void {
        Mail::fake();
        parent::setUp();
        $_SERVER['DOCUMENT_ROOT'] = public_path();
    }
}
