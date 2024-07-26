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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('booking_passengers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('age');
            $table->string('gender');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('booking_flights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id');
            $table->foreignId('passenger_id');
            $table->foreignId('flight_id');
            $table->integer('row_number');
            $table->string('seat_letter');
            $table->integer('baggage_weight')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_flights');
        Schema::dropIfExists('booking_passengers');
        Schema::dropIfExists('bookings');
    }
};
