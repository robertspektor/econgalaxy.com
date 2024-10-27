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
        Schema::create('player_origins', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // Unique name for the origin, e.g., "Federation Core Worlder"
            $table->foreignId('faction_id')->constrained()->onDelete('cascade'); // Reference to factions table
            $table->string('region')->nullable(); // General region, e.g., "Core sectors of the Galactic Federation"
            $table->text('description'); // Origin description
            $table->string('starting_ship'); // Ship type associated with this origin, e.g., "Federation Transporter"
            $table->string('manufacturer')->nullable(); // Manufacturer of the starting ship, e.g., "Galactic Federation Shipyards"
            $table->text('ship_description')->nullable(); // Description of the starting ship
            $table->json('benefits')->nullable(); // Array of benefits (json format)
            $table->json('drawbacks')->nullable(); // Array of drawbacks (json format)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('player_origins');
    }
};
