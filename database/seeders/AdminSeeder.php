<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@gmail.com'], // check uniqueness
            [
                'uid' => '920765', // unique UID
                'name' => 'Super Admin',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'boys@gmail.com'],
            [
                'uid' => 'boysadmin',
                'name' => 'Boys Admin',
                'password' => Hash::make('boysPass2026!'),
                'role' => 'boys_admin',
            ]
        );

        User::firstOrCreate(
            ['email' => 'girls@gmail.com'],
            [
                'uid' => 'girlsadmin',
                'name' => 'Girls Admin',
                'password' => Hash::make('girlsPass2026!'),
                'role' => 'girls_admin',
            ]
        );
    }
}
