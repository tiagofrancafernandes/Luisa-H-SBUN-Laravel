<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Borrow>
 */
class BorrowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'borrowed_at' => fake()->dateTimeBetween('7 days ago'),
            'returned_at' => fn (array $attr) => now()->create($attr['borrowed_at'] ?? null)->addDays(rand(1, 8)),
            'return_by' => fn (array $attr) => now()->create($attr['borrowed_at'] ?? null)->addDays(7),
            'user_id' => User::factory(),
            'book_id' => Book::factory(),
        ];
    }

    public function late(): static
    {
        return $this->state(fn (array $attributes) => [
            'borrowed_at' => now()->subDays(90),
            'return_by' => now()->subDays(90 - 7),
            'returned_at' => null,
        ]);
    }
}
