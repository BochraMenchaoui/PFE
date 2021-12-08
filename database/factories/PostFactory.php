<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'   => $this->faker->title,
            'body'    => '<html><body><p>' . $this->faker->paragraph . '</p></body></html>',
            'tags'    => 'seo,tunisia,history',
            'user_id' => random_int(2, 100),
        ];
    }
}
