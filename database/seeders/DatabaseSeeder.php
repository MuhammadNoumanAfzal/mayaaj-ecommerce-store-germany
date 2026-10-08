<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with essential admin and role accounts.
     */
    public function run(): void
    {
        // 1. Super Admin (Full Unrestricted Master Access)
        User::updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@mehaaj.de')],
            [
                'name' => 'MEHAAJ Super Admin',
                'password' => Hash::make(env('ADMIN_PASSWORD', 'password123')),
                'role' => 'super_admin',
                'is_active' => true,
            ]
        );

        // 2. Store Admin (Products, Orders, Customers, Inventory, Messages, Reviews)
        User::updateOrCreate(
            ['email' => 'manager@mehaaj.de'],
            [
                'name' => 'Elena Store Admin',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'is_active' => true,
            ]
        );

        // 3. Review Moderator (Moderates Reviews & Customer Contact Messages)
        User::updateOrCreate(
            ['email' => 'moderator@mehaaj.de'],
            [
                'name' => 'Sophia Moderator',
                'password' => Hash::make('password123'),
                'role' => 'moderator',
                'is_active' => true,
            ]
        );

        // 4. Inventory Staff (Catalog & Inventory Stock Control)
        User::updateOrCreate(
            ['email' => 'inventory@mehaaj.de'],
            [
                'name' => 'Marcus Stock Manager',
                'password' => Hash::make('password123'),
                'role' => 'inventory_manager',
                'is_active' => true,
            ]
        );
    }
}
