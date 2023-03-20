<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'over_name' => '細木',
            'under_name' => '智広',
            'over_name_kana' => 'ホソギ',
            'under_name_kana' => 'トモヒロ',
            'mail_address' => '1111@1111',
            'sex' => '1',
            'birth_day' => '19990101',
            'role' => '1',
            'password' => '11111111',
        ]);
    }
}
