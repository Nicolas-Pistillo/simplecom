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
            $table->string('external_shipping_id')->nullable();
            $table->string('provider_label')->nullable();
            $table->string('provider_service')->nullable();
            $table->string('provider_carrier')->nullable();
            $table->string('provider_carrier_logo')->nullable();
            $table->string('logistic_type');
            $table->string('status_code');
            $table->string('external_status')->nullable();
            $table->decimal('price_without_tax', 10)->nullable();
            $table->decimal('price', 10);
            $table->string('delivery_estimate')->nullable();
            $table->text('selected_branch')->nullable();
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
