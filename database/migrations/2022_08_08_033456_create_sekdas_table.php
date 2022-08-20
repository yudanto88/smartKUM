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
        Schema::create('sekdas', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('persetujuan')->nullable();
            $table->text('keterangan')->nullable();
            $table->string('validated')->nullable();
            $table->foreignId('kepala_dinas_id');
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
        Schema::dropIfExists('sekdas');
    }
};
