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
            ->assertSee('images/DapoerKopiIcon.png')
            ->assertSee('website simulasi toko kopi digital')
            ->assertSee('tidak menerima pesanan atau pembayaran sungguhan')
            ->assertSee('dinilai oleh guru');
    }

    public function test_login_and_registration_pages_use_the_existing_brand_icon(): void
    {
        $this->get(route('login'))
            ->assertOk()
            ->assertSee('images/DapoerKopiIcon.png');

        $this->get(route('register'))
            ->assertOk()
            ->assertSee('images/DapoerKopiIcon.png');
    }
}
