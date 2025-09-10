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
        Schema::create('custom_shipping_methods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('estimated_delivery')->nullable();
            $table->decimal('price', 10);
            $table->string('logo_url')->nullable();
            $table->string('shipping_zone_type');
            $table->string('selected_provinces')->nullable();
            $table->text('excluded_localities')->nullable();
            $table->string('zipcode_selection_type')->nullable();
            $table->text('zipcodes')->nullable();
            $table->integer('distance_km')->nullable();
            $table->text('conditions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_shipping_methods');
    }
};
