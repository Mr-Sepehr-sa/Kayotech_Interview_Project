<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Sepehr Sabzekar',
            'email' => 'test@bircode.net',
            'password' => '12345678#',
            'email_verified_at' => now(),
        ]);
        $user2 = User::create([
            'name' => 'Ali Alipoor',
            'email' => 'test2@bircode.net',
            'password' => '12345678#',
            'email_verified_at' => now(),
        ]);
        $user3 = User::create([
            'name' => 'reza rezapoor',
            'email' => 'test3@bircode.net',
            'password' => '12345678#',
            'email_verified_at' => now(),
        ]);

        $user->assignRole('Admin');
        $user2->assignRole('MidLevelAdmin');
        $user3->assignRole('user');
    }
}
