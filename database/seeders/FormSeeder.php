<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arNames = ['Программист'];
        $arCodes = ['program'];

        DB::table('forms')->insert([
            'name' => $arNames[0],
            'code' => $arCodes[0],
            'sort' => 100,
            'is_active' => 1,
            'company_id' => 3,
            'user_id' => 1,
        ]);
    }
}
