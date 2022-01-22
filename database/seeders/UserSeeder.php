<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Евгений',
            'email' => 'shmoulevsky@mail.ru',
            'phone' => '89232177338',
            'password' => Hash::make('12345678'),
            'company_id' => 1
        ]);
    }
}
