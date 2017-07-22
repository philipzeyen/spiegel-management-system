<?php

use Illuminate\Database\Seeder;

class MaskenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('masken_db')->insert([
            "masken_id" => 1,
            "name_maske" => "ersteMaske",
            "punkte" => NULL,
            "bilddatei" => NULL
        ]);

        DB::table('masken_db')->insert([
            "masken_id" => 2,
            "name_maske" => "zweiteMaske",
            "punkte" => NULL,
            "bilddatei" => NULL
        ]);
    }
}
