<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\TopicsSuggestion;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TopicsSuggestion>
 */
class TopicsSuggestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = TopicsSuggestion::class;

    public function definition(): array
    {
        return [
            'keyword_id' => \App\Models\KeywordsPool::factory(),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph(8),
            'source' => $this->faker->randomElement(['api', 'ai_generated', 'manual']),
            'status' => $this->faker->randomElement(['suggested', 'rejected', 'selected']),
        ];
    }
}
