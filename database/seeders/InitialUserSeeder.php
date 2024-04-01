<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InitialUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Lu Admin',
                'email' => 'lu@lu.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('power@123'),
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate([
                'email' => $userData['email'],
            ], $userData);
        }
    }
}
