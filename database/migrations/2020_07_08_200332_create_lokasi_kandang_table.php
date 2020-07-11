<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLokasiKandangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lokasi_kandang', function (Blueprint $table) {
            $table->bigIncrements('id_aktivitas_kandang');
            $table->bigInteger('kandang_id')->unsigned()->nullable();
            $table->foreign('kandang_id')
                ->references('id_kandang')
                ->on('kandang')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lokasi_kandang');
    }
}
