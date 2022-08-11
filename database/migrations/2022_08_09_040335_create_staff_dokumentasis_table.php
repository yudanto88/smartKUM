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
        Schema::create('staff_dokumentasis', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('ttd_walikota')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('keterangan_penolakan')->nullable();
            $table->foreignId('walikota_id')->nullable();
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
        Schema::dropIfExists('staff_dokumentasis');
    }
};
