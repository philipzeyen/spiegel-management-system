<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaskenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masken_db', function (Blueprint $table) {
            $table->unsignedInteger('masken_id', true);
            $table->string('name_maske')->unique('masken_db_unique_name');
            $table->binary('punkte')->nullable();
            $table->string('bilddatei')->nullable();
            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            //$table->primary('masken_id', 'masken_db_primary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('masken_db', function (Blueprint $table) {
            //$table->dropPrimary('masken_db_primary');
            $table->drop();
        });
    }
}
