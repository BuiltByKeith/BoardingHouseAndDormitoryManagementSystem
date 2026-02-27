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
        Schema::create('dormitory_room_tenants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_tenant_id')->constrained('student_tenants');
            $table->foreignId('dormitory_room_id')->constrained('dormitory_rooms');
            $table->foreignId('ay_semester_id')->constrained('ay_semesters');
            $table->integer('isActive');
            $table->integer('clearance_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dormitory_room_tenants');
    }
};
