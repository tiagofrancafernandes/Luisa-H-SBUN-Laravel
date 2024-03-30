<?php

namespace Database\Factories;

use App\Models\Borrow;
use Illuminate\Support\Arr;
use App\Enums\RequestBorrowStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RequestBorrow>
 */
class RequestReturnFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => Arr::random(RequestBorrowStatus::cases()),
            'borrow_id' => Borrow::factory(),
        ];
    }
}
