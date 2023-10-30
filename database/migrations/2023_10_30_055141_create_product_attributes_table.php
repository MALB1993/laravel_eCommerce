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
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('attribute_id');
            $table->foreign('attribute_id')->references('id')->on('attributes')->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreignId('product_id');
            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete()->cascadeOnUpdate();

            $table->string('value');
            $table->boolean('is_active')->default(1);


            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_attributes');
    }
};
