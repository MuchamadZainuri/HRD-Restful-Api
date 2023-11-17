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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->char('gender');
            $table->string('phone');
            $table->text('address');
            $table->string('email')->unique();
            $table->foreignId('employee_statuses_id')->constrained('employee_statuses')->default(1);
            $table->foreignId('hired_date_id')->constrained('hired_dates')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
