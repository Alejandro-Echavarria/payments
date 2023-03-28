<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'   => $this->faker->sentence,
            'image'   => $this->faker->imageUrl(640, 480, 'cats', true),
            'extract' => $this->faker->paragraph,
            'body'    => $this->faker->paragraph(3, true)
        ];
    }
}
