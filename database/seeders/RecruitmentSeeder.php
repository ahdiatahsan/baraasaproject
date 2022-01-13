<?php

namespace Database\Seeders;

use App\Models\Recruitment;
use Illuminate\Database\Seeder;

class RecruitmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Recruitment::factory()->count(3)->create();
    }
}
