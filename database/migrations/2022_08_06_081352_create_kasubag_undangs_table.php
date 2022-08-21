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
        Schema::create('kasubag_undangs', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->text('keterangan')->nullable();
            $table->text('keterangan_penolakan')->nullable();
            $table->string('validated')->nullable();
            $table->foreignId('staff_undang_id');
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
        Schema::dropIfExists('kasubag_undangs');
    }
};
