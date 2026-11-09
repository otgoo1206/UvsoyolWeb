<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('news_pages', function (Blueprint $table) {
            $table->id();

            $table->string('hero_h1')->nullable();
            $table->string('hero_h2')->nullable();
            $table->text('hero_p')->nullable();

            // News articles: title, description, image, date
            $table->json('news')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('news_pages');
    }
};
