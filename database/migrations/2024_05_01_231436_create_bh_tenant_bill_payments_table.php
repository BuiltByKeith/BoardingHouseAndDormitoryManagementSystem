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
        Schema::create('bh_tenant_bill_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bh_tenant_bill_id')->constrained('tenant_bills');
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
        Schema::dropIfExists('bh_tenant_bill_payments');
    }
};
