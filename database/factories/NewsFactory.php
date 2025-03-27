<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = \App\Models\News::class;

    public function definition(): array
    {
        return [
            'topic_id' => \App\Models\TopicsSuggestion::factory(),
            'title' => $this->faker->sentence,
            'content' => $this->faker->text,
            'status' => $this->faker->randomElement(['draft', 'scheduled', 'published']),
            'published_at' => now(),
        ];
    }
}
