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
            TariffSeeder::class,
            CompanySeeder::class,
            StatusSeeder::class,
            UserSeeder::class,
            FormSeeder::class,
            ResumeSeeder::class
        ]);


    }
}
