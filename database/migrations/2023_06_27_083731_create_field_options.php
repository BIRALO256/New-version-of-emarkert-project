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
        Schema::create('field_options', function (Blueprint $table) {
            $table->id();
            $table->string('value',40);
            // $table->string('created_by')->length(40);
            // $table->string('updated_by')->length(40);
            $table->foreignId('updated_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('created_by')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            // $table->unsignedBigInteger('subcategory_field_id');
            $table->foreignId('subcategory_field_id')->constrained('subcategory_fields')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreign('subcategory_field_id')->references('id')->on('subcategory_fields');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('field_options');
    }
};
