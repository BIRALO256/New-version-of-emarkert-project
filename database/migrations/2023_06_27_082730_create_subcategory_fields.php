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
        Schema::create('subcategory_fields', function (Blueprint $table) {
            $table->id();
            $table->string('name',30);
            // $table->string('created_by')->length(40);
            // $table->string('updated_by')->length(40);
            $table->foreignId('updated_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            // $table->unsignedBigInteger('product_subcategory_id');
            $table->foreignId('product_subcategory_id')->constrained('product_subcategorys')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreign('product_subcategory_id')->references('id')->on('product_subcategorys');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcategory_fields');
    }
};
