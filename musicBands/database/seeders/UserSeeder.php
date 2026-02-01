<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       User::updateOrCreate(
            ['email' => 'admin@musicbands.test'],
            [
                'name' => 'Admin',
                'password' => Hash::make('12345678'),
                'user_type' => User::TYPE_ADMIN,
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@musicbands.test'],
            [
                'name' => 'User',
                'password' => Hash::make('12345678'),
                'user_type' => User::TYPE_REGULAR,
            ]
        );

    }
}
