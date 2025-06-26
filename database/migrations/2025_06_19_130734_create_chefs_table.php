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
        Schema::create('chefs', function (Blueprint $table) {
            $table->unsignedBigInteger('Employee_ID')->primary();
            $table->string('Specialty', 50);
            $table->foreign('Employee_ID')->references('Employee_ID')->on('employees');
        });
            }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chefs');
    }
};
