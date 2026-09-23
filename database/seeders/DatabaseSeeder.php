<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with essential admin credentials only.
     */
    public function run(): void
    {
        // Ensure Admin Account Exists
        User::updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@mehaaj.de')],
            [
                'name' => 'MEHAAJ Admin',
                'password' => Hash::make(env('ADMIN_PASSWORD', 'password123')),
            ]
        );
    }
}
