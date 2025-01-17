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
            $table->string('reference');
            $table->foreignId('user_id');
            $table->string('status_code');
            $table->foreignId('payment_method_id');
            $table->boolean('invoiced')->default(false);
            $table->string('delivery_type');
            $table->foreignId('shipping_provider_id')->nullable();
            $table->decimal('shipping_cost', 10)->default(0);
            $table->decimal('subtotal', 10);
            $table->decimal('total', 10);
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
