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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('name');
            $table->string('lastname');
            $table->string('email');
            $table->string('document')->nullable();
            $table->string('phone')->nullable();
            $table->string('password')->nullable();
            $table->string('tax_condition')->nullable();
            $table->string('invoice_social_reason')->nullable();
            $table->string('invoice_document')->nullable();
            $table->string('invoice_address')->nullable();
            $table->string('google_id')->nullable();
            $table->string('facebook_id')->nullable();
            $table->boolean('newsletter_subscribed')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
