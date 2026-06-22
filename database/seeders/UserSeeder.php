<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's admin user.
     *
     * Uses updateOrCreate so this seeder is safe to run multiple times
     * (php artisan db:seed) without creating duplicate admin accounts
     * or throwing a unique-constraint error on 'email'.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name'     => 'Admin',
                'password' => Hash::make('admin123'),
            ]
        );
    }
}
