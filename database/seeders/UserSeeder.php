<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@tokosnack.com'],
            [
                'name' => 'Admin Laris Food',
                'phone' => '081234567890',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'owner@tokosnack.com'],
            [
                'name' => 'Owner Laris Food',
                'phone' => '081234567891',
                'password' => Hash::make('password'),
                'role' => 'owner',
            ]
        );

        User::updateOrCreate(
            ['email' => 'customer@tokosnack.com'],
            [
                'name' => 'Customer Laris Food',
                'phone' => '081234567892',
                'password' => Hash::make('password'),
                'role' => 'customer',
            ]
        );
    }
}