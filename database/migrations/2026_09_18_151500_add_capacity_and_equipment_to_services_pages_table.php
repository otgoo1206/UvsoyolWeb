<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services_pages', function (Blueprint $table) {
            $table->string('sec2_capacity')->nullable()->after('sec2_cards');
            $table->json('sec3_equipment')->nullable()->after('sec3_skills');
        });
    }

    public function down(): void
    {
        Schema::table('services_pages', function (Blueprint $table) {
            $table->dropColumn(['sec2_capacity', 'sec3_equipment']);
        });
    }
};
