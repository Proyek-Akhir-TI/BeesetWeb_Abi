<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePanenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('panen', function (Blueprint $table) {
            $table->bigIncrements('id_panen');
            $table->bigInteger('kandang_id')->unsigned()->nullable();
            $table->foreign('kandang_id')
                ->references('id_kandang')
                ->on('kandang')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('berat_panen');
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
        Schema::dropIfExists('panen');
    }
}
