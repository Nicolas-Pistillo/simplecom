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
        Schema::create('store_pickups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('zipcode');
            $table->string('street');
            $table->string('number');
            $table->string('locality');
            $table->string('state');
            $table->string('state_code')->nullable();
            $table->string('floor')->nullable();
            $table->string('local')->nullable();
            $table->string('schedule')->nullable();
            $table->string('observations')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('map_url')->nullable();
            $table->string('google_place_id')->nullable();
            $table->foreignId('created_by');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('store_pickups', fn(Blueprint $table) => $table->dropSoftDeletes());
        Schema::dropIfExists('store_pickups');
    }
};
