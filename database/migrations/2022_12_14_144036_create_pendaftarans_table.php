<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftaran', function (Blueprint $table) {
            $table->id();
            $table->string('id_pendaftaran')->unique();
            $table->unsignedBigInteger('user_id')->unique();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('nim');
            $table->string('nama_siswa');
            $table->string('prodi');
            $table->string('gender');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();

            $table->string('asal_sekolah')->nullable();
            $table->enum('pernah_mondok', ['pernah', 'tidakpernah'])->default('tidakpernah');
            $table->string('nama_pondok')->nullable();
            $table->string('lama')->nullable();
            $table->string('prestasi')->nullable();
            
            $table->string('berkas_siswa')->nullable();
            $table->string('pas_foto')->nullable();
            $table->string('status_pendaftaran');
            $table->datetime('tgl_pendaftaran');
            $table->string('tahun_masuk');
            $table->integer('gelombang');
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
        Schema::dropIfExists('pendaftaran');
    }
}
