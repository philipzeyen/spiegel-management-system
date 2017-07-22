<?php

use Illuminate\Database\Seeder;

class StelenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stele_db')->insert([
            'stelen_id' => 2,
            'name_stele'=> "Test_Stele",
            'standort'=> "Fiktives Haupttor",
            'status'=> 0,
            'loesch_markiert'=> 0,
            'letzteMeldung'=> "2017-04-13 00:00:00",
            'letzteDowntime'=> "2017-04-13 00:00:00",
            'user_id'=> 1,
            'config_id'=> 2,
        ]);

        DB::table('stele_db')->insert([
            'stelen_id' => 3,
            'name_stele'=> "WeitereStele",
            'standort'=> "Restaurant",
            'status'=> 0,
            'loesch_markiert'=> 0,
            'letzteMeldung'=> "2017-04-13 10:15:00",
            'letzteDowntime'=> "2017-04-11 00:00:00",
            'user_id'=> 1,
            'config_id'=> 1,
        ]);
    }
}
