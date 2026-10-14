<?php

namespace Tests\Feature;

use Database\Seeders\DemoDataSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use LogicException;
use Tests\TestCase;

class DemoDataSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_demo_seeder_creates_sample_data_once(): void
    {
        $this->seed(DemoDataSeeder::class);
        $this->seed(DemoDataSeeder::class);

        $this->assertDatabaseCount('menus', 4);
        $this->assertDatabaseCount('users', 3);
        $this->assertDatabaseCount('orders', 6);
        $this->assertDatabaseCount('order_items', 9);
        $this->assertDatabaseCount('menu_reviews', 4);
        $this->assertDatabaseCount('wishlists', 2);
        $this->assertSame(328000, (int) DB::table('orders')->sum('total'));
        $this->assertDatabaseHas('orders', ['status' => 'simulated']);
    }

    public function test_demo_seeder_refuses_to_run_in_production(): void
    {
        $this->app->detectEnvironment(fn (): string => 'production');
        $this->expectException(LogicException::class);

        $this->seed(DemoDataSeeder::class);
    }
}
