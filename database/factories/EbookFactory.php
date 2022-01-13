<?php

namespace Database\Factories;

use App\Models\Ebook;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EbookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ebook::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'thumbnail' => $this->faker->word,
            'file' => $this->faker->word,
            'user_id' => User::inRandomOrder()->first()
        ];
    }
}
