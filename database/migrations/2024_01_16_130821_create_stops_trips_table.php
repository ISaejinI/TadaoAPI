<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stops_trips', function (Blueprint $table) {
            $table->id();
            $table->integer('trip_id');
            $table->foreign('trip_id')->references('trip_id')->on('trips');
            $table->string('stop_id');
            $table->foreign('stop_id')->references('stop-id')->on('stops');
            $table->time('arrival_time');
            $table->time('departure_time');
            $table->integer('stop_sequence');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stops_trips');
    }
};
