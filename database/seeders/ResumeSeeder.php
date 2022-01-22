<?php

namespace Database\Seeders;

use App\Models\Resume\Resume;
use Illuminate\Database\Seeder;

class ResumeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Resume::factory()->count(20)->create();
    }
}
