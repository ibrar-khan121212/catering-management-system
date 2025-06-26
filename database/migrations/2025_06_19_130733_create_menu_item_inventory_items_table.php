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
        Schema::create('menuitem_inventoryitem', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('MenuItem_ID');
            $table->unsignedBigInteger('Inventory_ID');
            $table->integer('Quantity_Required');
            $table->foreign('MenuItem_ID')->references('MenuItem_ID')->on('menu_items');
            $table->foreign('Inventory_ID')->references('Inventory_ID')->on('inventory_items');
            $table->unique(['MenuItem_ID', 'Inventory_ID']); // optional
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menuitem_inventoryitem');
    }
};
