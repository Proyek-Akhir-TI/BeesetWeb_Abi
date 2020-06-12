<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sarangs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kandang_id')->unsigned()->nullable();
            $table->foreign('kandang_id')
                ->references('id')
                ->on('kandangs')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('berat_sarang1');
            $table->integer('berat_sarang2');
            $table->integer('berat_sarang3');
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
        Schema::dropIfExists('sarangs');
    }
}
