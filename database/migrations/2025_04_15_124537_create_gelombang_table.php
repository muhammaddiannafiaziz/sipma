<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGelombangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gelombang', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor_gelombang');
            $table->unsignedBigInteger('tahun_akademik_id');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('status', ['open', 'closed'])->default('closed');
            $table->timestamps();

            $table->foreign('tahun_akademik_id')
                  ->references('id')
                  ->on('tahun_akademik')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gelombang');
    }
}
