<?php

namespace Database\Seeders;

use App\Models\Borrow;
use Illuminate\Database\Seeder;
use App\Models\User;

class BorrowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::select('id')->each(function (User $user) {
            Borrow::factory(10)->create([
                'user_id' => $user?->id,
            ]);

            Borrow::factory(2)->create([
                'user_id' => $user?->id,
                'returned_at' => null,
            ]);
        });

        User::factory(5)->create()->each(function (User $user) {
            Borrow::factory(5)->create([
                'user_id' => $user?->id,
            ]);

            Borrow::factory(2)->create([
                'user_id' => $user?->id,
                'returned_at' => null,
            ]);
        });
    }
}
