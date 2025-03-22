<?php

namespace Database\Factories;

use App\Models\Trend;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trend>
 */
class TrendFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Trend::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'topic' => $this->faker->sentence(3),
            'country' => $this->faker->countryCode,
            'date' => $this->faker->date,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
