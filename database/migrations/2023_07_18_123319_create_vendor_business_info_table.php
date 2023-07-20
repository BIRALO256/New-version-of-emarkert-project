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
        Schema::create('vendor_business_info', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('owner_name');
            $table->string('id_type');
            $table->string('id_number');
            $table->string('id_attach_url');
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('city_town');
            $table->string('state_region');
            $table->string('country');
            $table->string('postal_code');
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
        Schema::dropIfExists('vendor_business_info');
    }
};
