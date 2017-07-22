<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaskenConfigRefTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //ROW_FORMAT=DYNAMIC;
        Schema::create('mask_config_ref', function (Blueprint $table) {
            $table->unsignedInteger('config_id');
            $table->unsignedInteger('masken_id');
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            //$table->primary(['masken_id', 'config_id'], 'mask_config_ref_primary');
            $table->foreign('config_id','mask_config_ref_config_fk')->references('config_id')->on('config_db')->onUpdate('cascade');
            $table->foreign('masken_id','mask_config_ref_masken_fk')->references('masken_id')->on('masken_db')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mask_config_ref', function (Blueprint $table) {
            //$table->dropPrimary('mask_config_ref_primary');
            //$table->dropForeign('mask_config_ref_config_fk');
            //$table->dropForeign('mask_config_ref_masken_fk');
            $table->drop();
        });
    }
}
