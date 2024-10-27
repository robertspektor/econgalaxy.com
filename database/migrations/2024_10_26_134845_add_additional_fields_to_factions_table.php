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
        Schema::table('factions', function (Blueprint $table) {
            $table->string('leader')->nullable()->after('drawbacks');
            $table->text('leader_bio')->nullable()->after('leader');
            $table->text('lore')->nullable()->after('leader_bio');
            $table->json('preferred_ship_types')->nullable()->after('lore');
            $table->json('allies')->nullable()->after('preferred_ship_types');
            $table->json('rivals')->nullable()->after('allies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('factions', function (Blueprint $table) {
            $table->dropColumn(['leader', 'leader_bio', 'lore', 'preferred_ship_types', 'allies', 'rivals']);
        });
    }
};
