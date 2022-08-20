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
        Schema::create('drafts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_id');
            $table->string('judul');
            $table->date('tanggal_pengajuan');
            $table->text('keterangan')->nullable();
            $table->string('surat_pengajuan');
            $table->string('draft_produk_hukum');
            $table->string('draft_produk_hukum_lama')->nullable();
            $table->text('keterangan_penolakan')->nullable();
            $table->string('status');
            $table->string('no_regristrasi')->nullable();
            $table->foreignId('user_id');
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
        Schema::dropIfExists('drafts');
    }
};
