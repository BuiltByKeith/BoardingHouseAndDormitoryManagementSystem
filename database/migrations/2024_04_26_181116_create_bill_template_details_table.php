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
        Schema::create('bill_template_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bill_template_id')->constrained('bill_templates');
            $table->foreignId('charge_id')->constrained('boarding_house_charges');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_template_details');
    }
};
