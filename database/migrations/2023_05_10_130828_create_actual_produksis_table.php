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
        Schema::create('actual_produksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('flowproses_id');
            $table->foreignId('proses_id');
            $table->date('tanggal');
            $table->timestamp('jam_mulai');
            $table->string('operator');
            $table->timestamp('jam_selesai')->nullable();
            $table->string('ket_selesai')->nullable();
            $table->integer('durasi')->nullable();
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
        Schema::dropIfExists('actual_produksis');
    }
};
