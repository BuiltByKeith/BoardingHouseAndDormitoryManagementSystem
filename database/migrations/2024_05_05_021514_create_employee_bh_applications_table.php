<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employee_bh_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained('employees');
            $table->string('boarding_house_name');
            $table->integer('sex_accepted');
            $table->integer('lodging_type');
            $table->string('classification');
            $table->string('complete_address');
            $table->double('longitude')->nullable();
            $table->double('latitude')->nullable();
            $table->integer('status');
            $table->string('comment')->nullable();
            $table->integer('isSeen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_bh_applications');
    }
};
