<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    protected static $seeded = false;

    protected function setUp(): void
    {
        parent::setUp();

        if (!static::$seeded) {
            $this->seed(\Database\Seeders\WorldSeeder::class);
            static::$seeded = true;
        }
    }
}
