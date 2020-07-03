<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKelompokIdToKandangs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kandangs', function (Blueprint $table) {
            $table->integer('kelompok_id')->nullable()->unsigned()->after('user_id');
            $table->foreign('kelompok_id')
                ->references('id')
                ->on('kelompoks')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kandangs', function (Blueprint $table) {
            //
        });
    }
}
