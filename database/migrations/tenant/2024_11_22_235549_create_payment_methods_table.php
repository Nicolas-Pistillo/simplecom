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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('service_class')->nullable();
            $table->string('display_name');
            $table->string('checkout_name');
            $table->text('description')->nullable();
            $table->boolean('active')->default(false);
            $table->boolean('needs_configuration')->default(true);
            $table->string('page_url')->nullable();
            $table->string('support_email')->nullable();
            $table->string('support_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
