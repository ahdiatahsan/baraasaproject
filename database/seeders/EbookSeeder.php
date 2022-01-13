<?php

namespace Database\Seeders;

use App\Models\Ebook;
use Illuminate\Database\Seeder;

class EbookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ebook::factory()->count(3)->create();
    }
}
