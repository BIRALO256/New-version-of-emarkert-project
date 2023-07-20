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
        Schema::create('vendors_shop_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('shop_name');
            $table->string('contact_name');
            $table->string('email_address');
            $table->string('contact_phone1');
            $table->string('contact_phone2')->nullable();
            $table->string('address_line1');
            $table->string('address_line2')->nullable();
            $table->string('city_town');
            $table->string('state_region');
            $table->string('country');
            $table->string('postal_code')->nullable();
            $table->string('created_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors_shop_information');
    }
};
