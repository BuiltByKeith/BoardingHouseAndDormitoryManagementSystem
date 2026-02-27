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
        Schema::create('dorm_bill_template_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dorm_bill_template_id')->constrained('dorm_bill_templates');
            $table->foreignId('dorm_charge_id')->constrained('dormitory_charges');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dorm_bill_template_details');
    }
};
