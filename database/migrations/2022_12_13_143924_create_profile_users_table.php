<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('nama');
            $table->string('username');
            $table->string('prodi')->nullable();
            $table->string('email')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('gender')->nullable();
            $table->string('agama')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('alamat')->nullable();
           
            $table->string('provinsi')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('jalan')->nullable();
            $table->string('kode_pos')->nullable();

             $table->string('nama_ortu')->nullable();
             $table->string('pekerjaan_ortu')->nullable();
             $table->string('pendidikan_ortu')->nullable();
             $table->string('nohp_ortu')->nullable();

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
        Schema::dropIfExists('profile_users');
    }
}
