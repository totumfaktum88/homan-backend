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
        /*Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('displayed_name');
            $table->string('code');
            $table->double('geo_lat');
            $table->double('geo_lng');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id');
            $table->string('displayed_name');
            $table->double('geo_lat');
            $table->double('geo_lng');
            $table->softDeletes();
            $table->timestamps();
        });*/
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        /*Schema::dropIfExists('cities');
        Schema::dropIfExists('countries');*/
    }
};
