<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKandangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kandang', function (Blueprint $table) {
            $table->bigIncrements('id_kandang');
            $table->string('nama');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')
                ->references('id_user')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('url');
            $table->bigInteger('kelompok_id')->unsigned()->nullable();
            $table->foreign('kelompok_id')
                ->references('id_kelompok')
                ->on('kelompok')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('foto')->nullable();
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
        Schema::dropIfExists('kandang');
    }
}
