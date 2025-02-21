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
            $table->foreignId('collection_point_id')->nullable();
            $table->foreignId('user_address_id');
            $table->string('external_reference')->nullable();
            $table->string('status');
            $table->string('external_status')->nullable();
            $table->string('external_status_id')->nullable();
            $table->string('external_status_description')->nullable();
            $table->string('checkout_url')->nullable();
            $table->string('logistic_type');
            $table->decimal('quoted_price', 10)->nullable();
            $table->decimal('final_price', 10)->nullable();
            $table->string('external_id')->nullable();
            $table->string('label_code')->nullable();
            $table->string('label_url')->nullable();
            $table->string('tracking_code')->nullable();
            $table->string('tracking_url')->nullable();
            $table->string('provider_label')->nullable();
            $table->string('provider_service')->nullable();
            $table->string('provider_service_code')->nullable();
            $table->string('provider_carrier')->nullable();
            $table->string('provider_carrier_code')->nullable();
            $table->string('provider_carrier_logo')->nullable();
            $table->string('delivery_estimate')->nullable();
            $table->text('calculated_rate')->nullable();
            $table->text('selected_branch')->nullable();
            $table->string('selected_branch_id')->nullable();
            $table->text('origin_branch')->nullable();
            $table->string('origin_branch_id')->nullable();
            $table->string('observations')->nullable();
            $table->text('meta')->nullable();
            $table->string('order_created_at')->nullable();
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
