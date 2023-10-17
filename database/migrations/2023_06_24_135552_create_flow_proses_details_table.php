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
        Schema::create('flow_proses_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('flowproses_id');
            $table->integer('urutan');
            $table->foreignId('proses_id');
            $table->integer('planningJam')->nullable()->default(0);
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
        Schema::dropIfExists('flow_proses_details');
    }
};
