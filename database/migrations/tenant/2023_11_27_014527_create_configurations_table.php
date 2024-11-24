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
        Schema::create('configurations', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('display_name');
            $table->string('topic')->nullable();
            $table->string('description')->nullable();
            $table->string('input_type')->default('text');
            $table->text('value')->nullable();
            $table->string('helper')->nullable();
            $table->boolean('show_in_setup')->default(false);
            $table->boolean('required')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configurations');
    }
};
