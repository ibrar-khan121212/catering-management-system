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
        Schema::create('payments', function (Blueprint $table) {
            $table->id('Payment_ID');
            $table->unsignedBigInteger('Customer_ID');
            $table->unsignedBigInteger('Order_ID');
            $table->date('Payment_Date');
            $table->decimal('Amount', 10, 2);
            $table->string('Method', 50);
            $table->timestamps();

            $table->foreign('Customer_ID')->references('Customer_ID')->on('customers');
            $table->foreign('Order_ID')->references('Order_ID')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
