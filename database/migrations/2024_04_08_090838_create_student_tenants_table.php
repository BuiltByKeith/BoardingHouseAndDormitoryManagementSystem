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
        Schema::create('student_tenants', function (Blueprint $table) {
            $table->id();
            $table->string('student_id');
            $table->string('institutional_email');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->string('extname')->nullable();
            $table->integer('sex');
            $table->foreignId('guardian_id')->constrained('student_tenant_guardians');
            $table->foreignId('program_id')->constrained('programs');
            $table->string('permanent_address');
            $table->string('contact_no');
          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_tenants');
    }
};
