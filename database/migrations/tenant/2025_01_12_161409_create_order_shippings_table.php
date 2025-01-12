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
        Schema::create('order_shippings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->foreignId('provider_id');
            $table->string('logistic_type');
            $table->string('shipping_id')->nullable();
            $table->string('status')->nullable();
            $table->string('dropoff_point_id')->nullable();
            $table->decimal('price_without_tax')->nullable();
            $table->decimal('price', 10);
            $table->string('delivery_estimate')->nullable();
            $table->text('calculated_rate')->nullable();
            $table->text('meta')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_shippings');
    }
};
