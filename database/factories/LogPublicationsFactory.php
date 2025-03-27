<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LogPublications>
 */
class LogPublicationsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\LogPublications::class;

    public function definition(): array
    {
        return [
            'news_id' => \App\Models\News::factory(),
            'published_at' => now(),
            'platform' => $this->faker->randomElement(['website', 'linkedin', 'twitter', 'newsletter']),
            'status' => $this->faker->randomElement(['success', 'failed', 'pending']),
        ];
    }
}
