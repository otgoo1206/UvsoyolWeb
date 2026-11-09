<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media_pages', function (Blueprint $table) {
            $table->id();

            $table->string('hero_h2')->nullable();

            // Video items: title, description, video, poster
            $table->json('videos')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media_pages');
    }
};
