<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk_hukums', function (Blueprint $table) {
            $table->id();
            $table->integer('nomor');
            $table->integer('tahun');
            $table->string('judul');
            $table->string('pemrakarsa');
            $table->string('status_dokumen');
            $table->string('status');
            $table->string('jenis');
            $table->string('subjek')->nullable();
            $table->string('sumber')->nullable();
            $table->string('no_regristrasi');
            $table->string('bidang_hukum')->nullable();
            $table->string('mengganti')->nullable();
            $table->date('tanggal_pengundangan');
            $table->boolean('publikasi')->default(0);
            $table->string('ttd_walikota_salinan')->nullable();
            $table->string('validated')->nullable();
            $table->foreignId('staff_dokumentasi_id');
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
        Schema::dropIfExists('produk_hukums');
    }
};
