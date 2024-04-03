<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class InitialUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::unguard(false);
        // dump(Model::isUnguarded());

        $users = [
            [
                'name' => 'Lu Admin',
                'email' => 'lu@lu.com',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'password' => Hash::make('power@123'),
                'is_admin' => true,
            ],
            [
                'name' => 'User 1',
                'email' => 'user1@mail.com',
                'password' => Hash::make('password'),
                'is_admin' => false,
            ],
        ];

        foreach ($users as $userData) {
            $user = User::updateOrCreate([
                'email' => $userData['email'],
            ], $userData);

            $user->is_admin = boolval($userData['is_admin'] ?? null);
            $user->save();
        }
    }
}
