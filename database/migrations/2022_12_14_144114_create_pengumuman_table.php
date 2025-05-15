<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengumumanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengumuman', function (Blueprint $table) {
            $table->id();
            $table->string('id_pengumuman')->unique();
            $table->string('id_pendaftaran');
            $table->foreign('id_pendaftaran')
                ->references('id_pendaftaran')
                ->on('pendaftaran')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->string('user_id')->nullable();
            $table->string('hasil_seleksi')->nullable();
            $table->integer('nilai_interview')->nullable();
            $table->integer('nilai_test')->nullable();
            $table->boolean('status');
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
        Schema::dropIfExists('pengumumn');
    }
}
