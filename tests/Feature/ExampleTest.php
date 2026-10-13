<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('Temukan biji kopi')
            ->assertDontSee('SIMULASI TOKO ONLINE')
            ->assertSee('DKVoc')
            ->assertSee('website simulasi toko kopi digital')
            ->assertSee('tidak menerima pesanan atau pembayaran sungguhan')
            ->assertSee('dinilai oleh guru');
    }
}
