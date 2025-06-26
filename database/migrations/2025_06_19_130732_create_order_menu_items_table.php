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
       Schema::create('order_menuitem', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Order_ID');
            $table->unsignedBigInteger('MenuItem_ID');
            $table->integer('Quantity');
            $table->text('Special_Notes')->nullable();
            $table->foreign('Order_ID')->references('Order_ID')->on('orders');
            $table->foreign('MenuItem_ID')->references('MenuItem_ID')->on('menu_items');
            $table->unique(['Order_ID', 'MenuItem_ID']); // Optional uniqueness constraint
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_menuitem');
    }
};
