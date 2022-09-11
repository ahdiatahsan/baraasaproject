<?php

namespace Database\Factories;

use App\Models\Recruitment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecruitmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Recruitment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'file' => $this->faker->word,
            'document_status' => $this->faker->boolean(),
            'interview_status' => $this->faker->boolean(),
            'user_id' => User::inRandomOrder()->first()
        ];
    }
}
