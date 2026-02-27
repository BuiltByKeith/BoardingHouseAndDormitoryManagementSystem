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
        Schema::create('student_tenant_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_tenant_id')->constrained('student_tenants');
            $table->integer('boarding_house_id')->nullable();
            $table->integer('dormitory_id')->nullable();
            $table->string('comment')->nullable();
            $table->string('reason')->nullable();
            $table->dateTime('date_in')->nullable();
            $table->dateTime('date_out')->nullable();
            $table->integer('clearance_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_tenant_histories');
    }
};
