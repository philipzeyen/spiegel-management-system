<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_db', function (Blueprint $table) {
            $table->unsignedInteger('config_id', true);
            $table->string('config_name', 50)->unique('config_db_unique_name');
            $table->binary("config_json")->nullable();
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            //$table->primary('config_id', 'config_db_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('config_db', function (Blueprint $table) {
            //$table->dropPrimary('config_db_primary');
            $table->drop();
        });
    }
}
