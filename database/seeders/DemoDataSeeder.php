<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuReview;
use App\Models\Order;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use LogicException;

class DemoDataSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (app()->environment('production')) {
            throw new LogicException('Demo data can only be seeded outside the production environment.');
        }

        DB::transaction(function (): void {
            $menuData = [
                'Arabika Nusantara' => [
                    'harga' => 28000,
                    'deskripsi' => 'Arabika dengan aroma floral dan rasa buah yang lembut.',
                ],
                'Robusta Temanggung' => [
                    'harga' => 22000,
                    'deskripsi' => 'Robusta dengan karakter bold dan sentuhan cokelat.',
                ],
                'Blend Senja' => [
                    'harga' => 30000,
                    'deskripsi' => 'Perpaduan arabika dan robusta untuk teman santai.',
                ],
                'Decaf Malam' => [
                    'harga' => 32000,
                    'deskripsi' => 'Kopi tanpa kafein dengan rasa ringan untuk sore hari.',
                ],
            ];

            $menus = [];

            foreach ($menuData as $name => $attributes) {
                $menus[$name] = Menu::firstOrCreate(
                    ['nama_menu' => $name],
                    [...$attributes, 'foto' => null],
                );
            }

            $customerData = [
                'demo.nadia@dapoerkopi.test' => 'Nadia Putri',
                'demo.raka@dapoerkopi.test' => 'Raka Pratama',
                'demo.sinta@dapoerkopi.test' => 'Sinta Maharani',
            ];

            $customers = [];

            foreach ($customerData as $email => $name) {
                $customers[$email] = User::firstOrCreate(
                    ['email' => $email],
                    [
                        'name' => $name,
                        'password' => Str::random(64),
                        'role' => 'user',
                    ],
                );
            }

            $reviews = [
                ['demo.nadia@dapoerkopi.test', 'Arabika Nusantara', 5, 'Aromanya wangi dan rasanya seimbang.'],
                ['demo.raka@dapoerkopi.test', 'Robusta Temanggung', 4, 'Cocok untuk kopi pagi, rasanya cukup kuat.'],
                ['demo.sinta@dapoerkopi.test', 'Blend Senja', 5, 'Enak diminum santai setelah beraktivitas.'],
                ['demo.nadia@dapoerkopi.test', 'Decaf Malam', 4, 'Ringan dan nyaman diminum sore hari.'],
            ];

            foreach ($reviews as [$customerEmail, $menuName, $rating, $review]) {
                MenuReview::firstOrCreate(
                    [
                        'menu_id' => $menus[$menuName]->id,
                        'user_id' => $customers[$customerEmail]->id,
                    ],
                    [
                        'rating' => $rating,
                        'review' => $review,
                    ],
                );
            }

            Wishlist::firstOrCreate([
                'user_id' => $customers['demo.nadia@dapoerkopi.test']->id,
                'menu_id' => $menus['Blend Senja']->id,
            ]);

            Wishlist::firstOrCreate([
                'user_id' => $customers['demo.raka@dapoerkopi.test']->id,
                'menu_id' => $menus['Decaf Malam']->id,
            ]);

            $customerEmails = array_keys($customerData);
            $hasExistingDemoOrders = Order::query()
                ->where('status', 'simulated')
                ->whereHas('user', function (Builder $query) use ($customerEmails): void {
                    $query->whereIn('email', $customerEmails);
                })
                ->exists();

            if ($hasExistingDemoOrders) {
                $this->command?->info('Demo customers already have sample orders; leaving their orders unchanged.');

                return;
            }

            $orderData = [
                ['demo.nadia@dapoerkopi.test', '2026-10-08 09:15:00', ['Arabika Nusantara' => 2]],
                ['demo.raka@dapoerkopi.test', '2026-10-09 10:30:00', ['Robusta Temanggung' => 1, 'Blend Senja' => 1]],
                ['demo.sinta@dapoerkopi.test', '2026-10-10 13:45:00', ['Decaf Malam' => 2]],
                ['demo.nadia@dapoerkopi.test', '2026-10-11 08:20:00', ['Blend Senja' => 1, 'Robusta Temanggung' => 1]],
                ['demo.raka@dapoerkopi.test', '2026-10-12 16:10:00', ['Arabika Nusantara' => 1, 'Decaf Malam' => 1]],
                ['demo.sinta@dapoerkopi.test', '2026-10-13 11:05:00', ['Robusta Temanggung' => 2]],
            ];

            foreach ($orderData as [$customerEmail, $createdAt, $items]) {
                if (Order::query()
                    ->where('user_id', $customers[$customerEmail]->id)
                    ->where('status', 'simulated')
                    ->where('created_at', $createdAt)
                    ->exists()) {
                    continue;
                }

                $total = collect($items)->sum(
                    fn (int $quantity, string $menuName): int => $menus[$menuName]->harga * $quantity,
                );

                $order = Order::create([
                    'user_id' => $customers[$customerEmail]->id,
                    'total' => $total,
                    'status' => 'simulated',
                ]);
                $order->forceFill(['created_at' => $createdAt, 'updated_at' => $createdAt])->save();

                foreach ($items as $menuName => $quantity) {
                    $menu = $menus[$menuName];
                    $orderItem = $order->items()->create([
                        'menu_id' => $menu->id,
                        'nama_menu' => $menu->nama_menu,
                        'harga' => $menu->harga,
                        'jumlah' => $quantity,
                        'subtotal' => $menu->harga * $quantity,
                    ]);
                    $orderItem->forceFill(['created_at' => $createdAt, 'updated_at' => $createdAt])->save();
                }
            }
        });
    }
}
