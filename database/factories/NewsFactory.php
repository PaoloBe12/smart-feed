<?php

namespace Database\Factories;

use App\Models\News;

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
    protected $model = News::class;

    public function definition(): array
    {
        return [
            'trend_id' => $this->faker->randomDigitNotNull,
            'title' => $this->faker->sentence(5),
            'description' => $this->faker->paragraph(5),
            'full_text' => $this->faker->paragraph(10),
            'metadata' => json_encode([
                'author' => $this->faker->name(),
                'tags' => $this->faker->words(3),
                'published_at' => $this->faker->dateTimeThisYear()->format('Y-m-d H:i:s'),
            ]),
            'seo_score' => $this->faker->randomDigitNotNull,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
