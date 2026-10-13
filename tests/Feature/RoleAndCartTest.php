<?php

namespace Tests\Feature;

use App\Models\Menu;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleAndCartTest extends TestCase
{
    use RefreshDatabase;

    public function test_regular_user_cannot_access_admin_menu_panel(): void
    {
        $user = User::factory()->create(['role' => 'user']);

        $this->actingAs($user)->get('/admin/menus')->assertForbidden();
    }

    public function test_admin_can_access_admin_menu_panel(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)->get('/admin/menus')->assertOk();
    }

    public function test_guest_can_browse_catalog_but_must_log_in_to_add_to_cart(): void
    {
        $menu = Menu::create([
            'nama_menu' => 'Biji Kopi Sangrai',
            'harga' => 18000,
            'deskripsi' => 'Biji kopi untuk seduhan di rumah.',
        ]);

        $this->get(route('menus.index'))
            ->assertOk()
            ->assertSee('Biji Kopi Sangrai');

        $this->post(route('cart.store', $menu))
            ->assertRedirect(route('login'));
    }

    public function test_catalog_can_filter_search_and_sort_by_price(): void
    {
        Menu::create([
            'nama_menu' => 'Arabica Reserve',
            'harga' => 35000,
            'deskripsi' => 'Kopi Arabica dengan rasa yang seimbang.',
        ]);

        Menu::create([
            'nama_menu' => 'Robusta Classic',
            'harga' => 22000,
            'deskripsi' => 'Kopi robusta untuk seduhan harian.',
        ]);

        $response = $this->get(route('menus.index', [
            'search' => 'arabica',
            'price' => '20000_40000',
            'sort' => 'price_asc',
        ]));

        $response->assertOk()
            ->assertSee('Arabica Reserve')
            ->assertDontSee('Robusta Classic');
    }

    public function test_user_can_toggle_wishlist_for_a_menu(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $menu = Menu::create([
            'nama_menu' => 'Kopi Luwak',
            'harga' => 25000,
            'deskripsi' => 'Kopi dengan rasa lembut.',
        ]);

        $this->actingAs($user)
            ->post(route('wishlist.toggle', $menu))
            ->assertRedirect();

        $this->assertDatabaseHas('wishlists', [
            'user_id' => $user->id,
            'menu_id' => $menu->id,
        ]);

        $this->actingAs($user)
            ->post(route('wishlist.toggle', $menu))
            ->assertRedirect();

        $this->assertDatabaseMissing('wishlists', [
            'user_id' => $user->id,
            'menu_id' => $menu->id,
        ]);
    }

    public function test_user_can_submit_a_rating_for_a_menu(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $menu = Menu::create([
            'nama_menu' => 'Kopi Toraja',
            'harga' => 42000,
            'deskripsi' => 'Citarasa yang kaya dan kompleks.',
        ]);

        $this->actingAs($user)
            ->post(route('menus.rate', $menu), [
                'rating' => 5,
                'review' => 'Rasanya lembut dan enak untuk pagi hari.',
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('menu_reviews', [
            'menu_id' => $menu->id,
            'user_id' => $user->id,
            'rating' => 5,
        ]);
    }

    public function test_user_can_checkout_items_from_cart(): void
    {
        $user = User::factory()->create(['role' => 'user']);
        $menu = Menu::create([
            'nama_menu' => 'Kopi Tubruk',
            'harga' => 15000,
            'deskripsi' => 'Kopi hitam klasik.',
        ]);

        $this->actingAs($user)
            ->post(route('cart.store', $menu), ['jumlah' => 2])
            ->assertRedirect(route('menus.index'));

        $this->actingAs($user)
            ->post(route('cart.checkout'))
            ->assertRedirect(route('orders.index'));

        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'total' => 30000,
            'status' => 'simulated',
        ]);
        $this->assertDatabaseHas('order_items', [
            'menu_id' => $menu->id,
            'jumlah' => 2,
            'subtotal' => 30000,
        ]);
    }
}