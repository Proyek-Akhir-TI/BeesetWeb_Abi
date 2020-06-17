<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAktivitasPeternaksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aktivitas_peternaks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('kandang_id')->unsigned()->nullable();
            $table->foreign('kandang_id')
                ->references('id')
                ->on('kandangs')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('aktivitas_id')->unsigned()->nullable();
            $table->foreign('aktivitas_id')
                ->references('id')
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
        Schema::dropIfExists('aktivitas_peternaks');
    }
}
