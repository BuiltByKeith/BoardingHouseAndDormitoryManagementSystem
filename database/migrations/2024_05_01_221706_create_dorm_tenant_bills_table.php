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
        Schema::create('dorm_tenant_bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dorm_room_tenant_id')->constrained('dormitory_room_tenants');
            $table->foreignId('dorm_bill_template_id')->constrained('dorm_bill_templates');
            $table->dateTime('month');
            $table->integer('payment_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dorm_tenant_bills');
    }
};
