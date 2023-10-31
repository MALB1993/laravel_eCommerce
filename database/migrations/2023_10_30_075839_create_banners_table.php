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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();

            $table->string('image');
            $table->string('title')->nullable();
            $table->text('text')->nullable();
            $table->integer('priority')->nullable();
            $table->boolean('is_active')->default(1);
            $table->string('type');

            $table->string('button_text');
            $table->string('button_link');
            $table->string('button_icon');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};