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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            // $table->date('date_listed');
            // $table->string('created_by')->length(40);
            // $table->string('updated_by')->length(40);
            $table->foreignId('updated_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            // $table->unsignedBigInteger('product_category_id');
            // $table->double('reward_pionts_credit');
            $table->decimal('reward_pionts_credit')->nullable();
            // $table->foreign('product_category_id')->references('id')->on('categories');
            $table->foreignId('product_category_id')->constrained('categories')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreign('product_category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
