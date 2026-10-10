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