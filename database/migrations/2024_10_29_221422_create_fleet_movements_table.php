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
        Schema::create('fleet_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fleet_id')->constrained('fleets')->onDelete('cascade'); // Flotte, die sich bewegt
            $table->foreignId('start_sector_id')->nullable()->constrained('sectors')->onDelete('set null'); // Ausgangssektor
            $table->foreignId('destination_sector_id')->nullable()->constrained('sectors')->onDelete('set null'); // Zielsektor
            $table->timestamp('departure_time'); // Startzeit der Bewegung
            $table->timestamp('arrival_time'); // Geplante Ankunftszeit im Zielsektor
            $table->enum('status', ['in_progress', 'completed', 'aborted'])->default('in_progress'); // Bewegungsstatus
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fleet_movements');
    }
};
