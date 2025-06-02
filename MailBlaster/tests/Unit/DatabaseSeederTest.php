<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Seeders\DatabaseSeeder;
use App\Models\User;

class DatabaseSeederTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function ejecuta_seeders_y_crea_datos_base()
    {
        $this->seed(DatabaseSeeder::class);

        $this->assertGreaterThan(0, User::count());
    }
}
