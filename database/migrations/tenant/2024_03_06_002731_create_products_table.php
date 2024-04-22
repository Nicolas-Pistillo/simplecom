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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('category_id');
            $table->float('price');
            $table->integer('discount_percent')->nullable();
            $table->integer('stock')->default(0);
            $table->integer('min_sale')->default(1);
            $table->integer('max_sale')->nullable();
            $table->float('width');
            $table->float('height');
            $table->float('length');
            $table->float('weight');
            $table->boolean('published')->default(false);
            $table->boolean('featured')->default(false);
            $table->foreignId('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
