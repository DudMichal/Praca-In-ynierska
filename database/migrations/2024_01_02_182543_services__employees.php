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
        Schema::create('services_employees', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('service_id');
        $table->foreign('service_id')
              ->references('id')
              ->on('services')->onDelete('cascade');
        $table->unsignedBigInteger('employee_id');
        $table->foreign('employee_id')
              ->references('id')
              ->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services_employees');
    }
};
