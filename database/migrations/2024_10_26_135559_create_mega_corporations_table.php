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
        Schema::create('mega_corporations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->foreignId('faction_id')->nullable()->constrained()->onDelete('set null'); // Link to primary faction
            $table->string('specialization')->nullable(); // Specialized ship technology
            $table->string('color')->nullable(); // Visual color identifier
            $table->string('logo')->nullable(); // Path to the corporation's logo image
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mega_corporations');
    }
};
