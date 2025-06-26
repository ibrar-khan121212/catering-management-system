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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('Order_ID');
            $table->unsignedBigInteger('Customer_ID');
            $table->unsignedBigInteger('Event_ID');
            $table->date('Order_Date');
            $table->string('Status', 50);
            $table->timestamps();

            $table->foreign('Customer_ID')->references('Customer_ID')->on('customers');
            $table->foreign('Event_ID')->references('Event_ID')->on('events');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
