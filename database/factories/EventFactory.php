<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title,
            'slug' => $this->faker->slug,
            'body' => $this->faker->sentence,
            'thumbnail' => $this->faker->word,
            'date_start' => $this->faker->date,
            'date_end' => $this->faker->date,
            'location' => $this->faker->city,
            'event_status' => $this->faker->boolean()
        ];
    }
}
