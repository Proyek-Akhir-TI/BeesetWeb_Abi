<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePanensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('panens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('kandang_id')->unsigned()->nullable();
            $table->foreign('kandang_id')
                ->references('id')
                ->on('kandangs')
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
        Schema::dropIfExists('panens');
    }
}
