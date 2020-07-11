<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id_user');
            $table->string('nama');
            $table->integer('role_id')->unsigned()->nullable();
            $table->foreign('role_id')
                ->references('id_role')
                ->on('roles')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->text('alamat');
            $table->string('telpon');
            $table->bigInteger('kelompok_id')->unsigned()->nullable();
            $table->foreign('kelompok_id')
                ->references('id_kelompok')
                ->on('kelompok')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('photo');
            $table->string('api_token');
            $table->integer('status');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
