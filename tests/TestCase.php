<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // Debug: check DB connection
        dump(config('database.default')); // should print "mysql"

        // Run migrations before each test
        $this->artisan('migrate');
    }

}

