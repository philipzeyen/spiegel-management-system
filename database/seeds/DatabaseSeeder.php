<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(ConfigTableSeeder::class);
        $this->call(StelenTableSeeder::class);
        $this->call(MaskenTableSeeder::class);
        $this->call(MaskenConfigRefTableSeeder::class);
    }
}
