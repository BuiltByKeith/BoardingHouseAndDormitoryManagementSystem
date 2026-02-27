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
        Schema::create('dorm_tenant_bill_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dorm_tenant_bill_id')->constrained('dorm_tenant_bills');
            $table->string('receipt_no');
            $table->double('amount');
            $table->string('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dorm_tenant_bill_payments');
    }
};
