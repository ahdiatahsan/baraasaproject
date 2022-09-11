<?php

namespace Database\Factories;

use App\Models\Setting;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Setting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => 'baradanasa@gmail.com',
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'instagram' => 'https://www.instagram.com/baraasa.project/',
            'spotify' => 'https://open.spotify.com/show/7ill8y7DsenVbgk41o6Oi5?si=0e50d2789341459e',
            'recruitment_status' => "Ditutup",
            'recruitment_thumbnail' => $this->faker->name,
        ];
    }
}
