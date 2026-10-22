<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence(6);

        return [
            'title' => $title,
            'slug' => Str::slug($title) . '-' . fake()->unique()->numberBetween(1, 999999),
            'excerpt' => fake()->sentence(),
            'body' => fake()->paragraphs(3, true),
            'is_published' => fake()->boolean(75),
            'published_at' => now(),
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
        ];
    }

    public function published(): static
    {
        return $this->state(fn () => [
            'is_published' => true,
            'published_at' => now(),
        ]);
    }
}
