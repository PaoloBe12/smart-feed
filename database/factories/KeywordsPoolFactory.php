<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\KeywordsPool;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class KeywordsPoolFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    protected $model = KeywordsPool::class;

    public function definition(): array
    {
        return [
            'keyword' => $this->faker->unique()->word,
            'seo_score' => $this->faker->randomFloat(2, 0, 100),
            'source' => $this->faker->randomElement(['google_trends', 'reddit', 'manual', 'ai_generated']),
        ];
    }
}
