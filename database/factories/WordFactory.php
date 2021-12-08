<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Word;
use Illuminate\Database\Eloquent\Factories\Factory;

class WordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Word::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'word_ar'     => $this->faker->title,
            'word_lt'     => $this->faker->title,
            'ar'          => $this->faker->title,
            'fr'          => $this->faker->title,
            'en'          => $this->faker->title,
            'description' => $this->faker->paragraph,
            'origin'      => $this->faker->title,
            'region'      => $this->faker->title,
            'user_id'     => random_int(2, 100),
            'created_at'  => Carbon::today()->subDays(35),
        ];
    }
}
