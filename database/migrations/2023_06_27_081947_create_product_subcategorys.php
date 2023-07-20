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
        Schema::create('product_subcategorys', function (Blueprint $table) {
            $table->id();
            $table->string('name',30);
            // $table->string('created_by')->length(40);
            // $table->string('updated_by')->length(40);
            $table->foreignId('updated_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            // $table->unsignedBigInteger('product_category_id');
            $table->foreignId('product_category_id')->constrained('categories')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreign('product_category_id')->references('id')->on('product_categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_subcategorys');
    }
};
