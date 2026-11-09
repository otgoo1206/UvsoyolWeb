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
        Schema::create('products_pages', function (Blueprint $table) {
            $table->id();

            // Hero section
            $table->string('hero_h1')->nullable();
            $table->string('hero_h2')->nullable();
            $table->text('hero_p')->nullable();

            // Product catalog: name, category, description, image, price
            $table->json('products')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_pages');
    }
};
