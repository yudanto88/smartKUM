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
            $table->string('no_tahun');
            $table->string('tentang');
            $table->string('subjek');
            $table->string('status');
            $table->date('tanggal_pengundangan');
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
