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
        Schema::create('product_items', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity_in_stock');
            $table->integer('price');
            $table->string('S_K_U');
            // $table->string('created_by')->length(40);
            // $table->string('updated_by')->length(40);
            $table->foreignId('updated_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            // $table->unsignedBigInteger('product-id');
            $table->foreignId('product-id')->constrained('products')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreign('product-id')->references('id')->on('products');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_items');
    }
};
