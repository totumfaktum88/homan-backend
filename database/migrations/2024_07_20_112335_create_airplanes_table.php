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
        Schema::create('airplanes', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->integer('available_seats');
            $table->integer('row_count');
            $table->integer('seat_count');
            $table->json('seat_order');
            $table->integer('max_baggage_weight');
            $table->integer('max_baggage_count');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airplanes');
    }
};
