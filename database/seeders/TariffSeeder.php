<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TariffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tariffs')->insert([
            'name' => 'Пробный',
            'code' => 'base',
            'sort' => 100,
            'is_active' => true,
            'amount' => 0,
        ]);

        DB::table('tariffs')->insert([
            'name' => 'Базовый',
            'code' => 'base',
            'sort' => 200,
            'is_active' => true,
            'amount' => 50,
        ]);

        DB::table('tariffs')->insert([
            'name' => 'Расширенный',
            'code' => 'advanced',
            'sort' => 300,
            'is_active' => true,
            'amount' => 150,
        ]);
    }
}
