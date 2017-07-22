<?php

use Illuminate\Database\Seeder;

class MaskenConfigRefTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mask_config_ref')->insert([
            "config_id" => 1,
            "masken_id" => 1
        ]);

        DB::table('mask_config_ref')->insert([
            "config_id" => 2,
            "masken_id" => 2
        ]);
    }
}
