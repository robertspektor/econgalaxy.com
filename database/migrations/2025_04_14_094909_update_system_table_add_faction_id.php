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
        Schema::table('systems', function (Blueprint $table) {
            $table->bigInteger('faction_id')->unsigned()->nullable()->after('y');
            $table->foreign('faction_id')->references('id')->on('factions')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('systems', function (Blueprint $table) {
            $table->bigInteger('faction_id')->unsigned()->nullable()->after('y');
            $table->foreign('faction_id')->references('id')->on('factions')->onDelete('set null');
        });
    }
};
