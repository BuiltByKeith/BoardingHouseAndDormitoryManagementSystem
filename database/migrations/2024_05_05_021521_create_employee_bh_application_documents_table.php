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
        Schema::create('employee_bh_application_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_bh_app_id')->constrained('employee_bh_applications');
            $table->string('document_name')->nullable();
            $table->string('file_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_bh_application_documents');
    }
};
