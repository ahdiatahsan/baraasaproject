<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DivisionSeeder::class,
            PositionSeeder::class,
            UserSeeder::class,
            BlogSeeder::class,
            ResearchSeeder::class,
            ThreadSeeder::class,
            CommentSeeder::class,
            EventSeeder::class,
            ParticipantSeeder::class,
            RecruitmentSeeder::class,
            SettingSeeder::class
        ]);
    }
}
