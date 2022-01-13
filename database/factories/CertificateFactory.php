<?php

namespace Database\Factories;

use App\Models\Certificate;
use App\Models\Participant;
use Illuminate\Database\Eloquent\Factories\Factory;

class CertificateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Certificate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'file' => $this->faker->word,
            'participant_id' => Participant::inRandomOrder()->first()
        ];
    }
}
