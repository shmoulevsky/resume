<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'name' => 'Веб-Идея',
            'code' => 'webidea',
            'sort' => 200,
            'is_active' => true,
            'tariff_id' => 1
        ]);

        DB::table('companies')->insert([
            'name' => 'ООО СтройИнвест',
            'code' => 'stroy',
            'sort' => 200,
            'is_active' => true,
            'tariff_id' => 2
        ]);
    }
}
