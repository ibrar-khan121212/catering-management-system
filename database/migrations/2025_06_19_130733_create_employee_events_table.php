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
        Schema::create('employee_events', function (Blueprint $table) {
            $table->id(); // Primary Key
        $table->unsignedBigInteger('Employee_ID');
        $table->unsignedBigInteger('Event_ID');
        $table->string('Role_in_Event', 50);
        $table->string('Shift_Time', 20);
        $table->timestamps();

        $table->unique(['Employee_ID', 'Event_ID']); // Prevent duplicate assignment
        $table->foreign('Employee_ID')->references('Employee_ID')->on('employees')->onDelete('cascade');
        $table->foreign('Event_ID')->references('Event_ID')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_event');
    }
};
