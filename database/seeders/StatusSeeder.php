<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arStatuses = [
            'not' => 'Не рассмотрено',
            'inwork' => 'В работе',
            'test' => 'Тест',
            'interview' => 'Собеседование',
            'employment' => 'Трудоустройство',
            'reject' => 'Отказ',
        ];

        $sort = 0;

        foreach ($arStatuses as $code => $status) {

            $sort += 10;
            DB::table('resume_statuses')->insert([
                'name' => $status,
                'code' => $code,
                'sort' => $sort,
                'is_active' => true,
            ]);
        }


    }
}
