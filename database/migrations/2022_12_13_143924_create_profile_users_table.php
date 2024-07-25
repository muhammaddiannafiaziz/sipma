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
            $table->string('semester')->nullable();
            $table->string('foto')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('gender')->nullable();
            $table->string('agama')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('alamat')->nullable();
           
            $table->string('provinsi')->nullable();
            // $table->foreign('provinsi_id')
            //     ->references('id')
            //     ->on('provinces')
            //     ->onUpdate('cascade')->onDelete('cascade');

            $table->string('kabupaten')->nullable();
            // $table->foreign('kabupaten_id')
            //     ->references('id')
            //     ->on('regencies')
            //     ->onUpdate('cascade')->onDelete('cascade');

            $table->string('kecamatan')->nullable();
            // $table->foreign('kecamatan_id')
            //     ->references('id')
            //     ->on('districts')
            //     ->onUpdate('cascade')->onDelete('cascade');

            $table->string('kelurahan')->nullable();
            $table->string('kode_pos')->nullable();
            // $table->foreign('kelurahan_id')
            //     ->references('id')
            //     ->on('villages')
            //     ->onUpdate('cascade')->onDelete('cascade');

             //data orang tua
             $table->string('nama_ayah')->nullable();
             $table->string('nama_ibu')->nullable();
             $table->string('pekerjaan_ayah')->nullable();
             $table->string('pekerjaan_ibu')->nullable();
             $table->string('pendidikan_ayah')->nullable();
             $table->string('pendidikan_ibu')->nullable();
             $table->string('nohp_ayah')->nullable();
             $table->string('nohp_ibu')->nullable();
 
            // $table->string('berkas_ortu');//kk akte ijazah raport penghasilan

            //data asal sekolah
            // $table->string('sekolah_sd')->nullable();
            // $table->string('sekolah_smp')->nullable();
            $table->string('sekolah_sma')->nullable();
            // $table->string('berkas_siswa');//kk akte ijazah raport
            $table->string('prestasi')->nullable();

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
