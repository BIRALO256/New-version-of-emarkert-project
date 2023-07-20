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
        Schema::create('product_category_promotions', function (Blueprint $table) {
            $table->id();
            $table->integer('discount_value');
            $table->integer('discount_unit');
            $table->dateTime('valid_until');
            $table->dateTime('date_created');
            $table->string('coupon_code',30);
            $table->integer('minimum_order_value');
            $table->integer('maximum _discount_amount');
            $table->string('is_redeem-allowed',1);
            $table->dateTime('valid_from');
            // $table->string('created_by')->length(40);
            // $table->string('updated_by')->length(40);
            $table->foreignId('updated_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            // $table->unsignedBigInteger('promo-product-category-id');
            $table->foreignId('promo-product-category-id')->constrained('categories')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreign('promo-product-category-id')->references('id')->on('product_categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_category_promotions');
    }
};
