<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Photo>
 */
class PhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'album_id' => null,
            'uploader_id' => null,
            'uploader_name' => null,
            'filename' => $this->faker->word() . '.jpg',
            'type' => 'image/jpeg',
            'size' => $this->faker->numberBetween(1000, 5000),
        ];
    }
}
