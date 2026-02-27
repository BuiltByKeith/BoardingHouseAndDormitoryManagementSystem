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
        Schema::create('boarding_house_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('room_name');
            $table->integer('number_of_beds');
            $table->foreignId('boarding_house_id')->constrained('boarding_houses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boarding_house_rooms');
    }
};
