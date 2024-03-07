<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name')->unique();
            $table->string('ecommerce_name');
            $table->string('logo_url')->nullable();
            $table->string('color')->nullable();
            $table->foreignId('sector_id');
            $table->foreignId('plan_id');
            $table->boolean('active')->default(true);
            $table->boolean('setup_completed')->default(false);
            $table->timestamps();
            $table->json('data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants'); 
    }
}
