<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // $table->unsignedBigInteger('product_category_id');
            // $table->foreign('product_category_id')->references('id')->on('categories');
            $table->foreignId('product_category_id')->constrained('categories')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreign('product_category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
