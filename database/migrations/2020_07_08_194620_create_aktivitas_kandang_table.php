<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAktivitasKandangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aktivitas_kandang', function (Blueprint $table) {
            $table->bigIncrements('id_aktivitas_kandang');
            $table->bigInteger('kandang_id')->unsigned()->nullable();
            $table->foreign('kandang_id')
                ->references('id_kandang')
                ->on('kandang')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->bigInteger('aktivitas_id')->unsigned()->nullable();
            $table->foreign('aktivitas_id')
                ->references('id_jenis_aktivitas')
                ->on('jenis_aktivitas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('aktivitas_kandang');
    }
}
