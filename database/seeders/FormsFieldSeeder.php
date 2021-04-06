<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormsFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arQuestions = [
            ['name' => 'Опишите Ваши проекты', 'type' => '2', 'is_reqired' => '1', 'step' => '1', 'sort' => '100', 'form_id' => 1, 'comapny_id' => 3, 'user_id' => 1],
            ['name' => 'Ваши ожидания от нашей компании', 'type' => '2', 'is_reqired' => '1', 'step' => '1', 'sort' => '100', 'form_id' => 1, 'comapny_id' => 3, 'user_id' => 1],
            ['name' => 'Какими языками программирования Вы владеете?', 'type' => '2', 'is_reqired' => '1', 'step' => '1', 'sort' => '100', 'form_id' => 1, 'comapny_id' => 3, 'user_id' => 1],
            ['name' => 'Желаемый уровень заработной платы', 'type' => '2', 'is_reqired' => '1', 'step' => '1', 'sort' => '100', 'form_id' => 1, 'comapny_id' => 3, 'user_id' => 1],
        ];

        foreach ($arQuestions as $key => $value) {
            DB::table('forms_fields')->insert([
                'name' =>$value['name'],
                'description' => '-',
                'code' => '-',
                'type' => $value['type'],
                'step' => $value['step'],
                'size' => 100,
                'is_active' => 1,
                'is_required' => 1,
                'sort' => $value['sort'],
                'form_id' => 2,
                'company_id' => 3,
                'user_id' => 1,
            ]);
        }
    }
}
