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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreignId('address_id');
            $table->foreign('address_id')->references('id')->on('user_addresses')->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreignId('coupon_id')->nullable();
            $table->foreign('coupon_id')->references('id')->on('coupons')->cascadeOnDelete()->cascadeOnUpdate();

            $table->tinyInteger('status')->default(0);

            $table->unsignedInteger('total_amount');
            $table->unsignedInteger('delivery_amount')->nullable();

            $table->unsignedInteger('coupon_amount')->default(0);
            $table->unsignedInteger('paying_amount')->default(0);

            $table->enum('payment_type',['pos','cash','shabaNumber','card_to_card','online']);
            $table->tinyInteger('payment_status')->default(0);

            $table->text('description')->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
