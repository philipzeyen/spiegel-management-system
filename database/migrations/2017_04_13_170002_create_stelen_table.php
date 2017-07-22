<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStelenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stele_db', function (Blueprint $table) {
            $table->unsignedInteger('stelen_id', true);
            $table->string('name_stele', 50)->unique('stele_db_unique_name');
            $table->string('standort', 255);
            $table->boolean('status')->default(false)->comment('0 = False; 1 = True');
            $table->boolean('loesch_markiert')->default(false)->comment('0 = False; 1 = True');
            $table->dateTime('letzteMeldung')->nullable()->default(NULL);
            $table->dateTime('letzteDowntime')->nullable()->default(NULL);
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('config_id')->nullable();

            //$table->primary('stelen_id', 'stele_db_primary');
            $table->foreign('user_id', 'stele_db_users_fk')->references('id')->on('users')->onUpdate('cascade')->onDelete("set null");
            $table->foreign('config_id', 'stele_db_config_fk')->references('config_id')->on('config_db')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stele_db', function (Blueprint $table) {
            //$table->dropForeign('stele_db_users_fk');
            //$table->dropForeign('stele_db_config_fk');
            //$table->dropUnique('stele_db_unique_name');
            //$table->dropPrimary('stele_db_primary');
            $table->drop();
        });
    }
}
