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
        Schema::table('fleets', function (Blueprint $table) {
            $table->foreignId('system_id')->nullable()->constrained('systems')->onDelete('set null'); // Derzeitiges System der Flotte (falls im System)
            $table->foreignId('current_sector_id')->nullable()->constrained('sectors')->onDelete('set null'); // Aktueller Sektor der Flotte
            $table->foreignId('destination_sector_id')->nullable()->constrained('sectors')->onDelete('set null'); // Zielsektor der Flotte (falls unterwegs)
            $table->enum('status', ['standby', 'docked', 'moving', 'combat', 'exploring'])->default('standby')->change(); // Status der Flotte
            $table->timestamp('departure_time')->nullable(); // Abfahrtszeit (nur wenn unterwegs)
            $table->timestamp('arrival_time')->nullable(); // Ankunftszeit im Zielsektor (nur wenn unterwegs)

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fleets', function (Blueprint $table) {
            $table->dropForeign(['system_id']);
            $table->dropColumn('system_id');
            $table->dropForeign(['current_sector_id']);
            $table->dropColumn('current_sector_id');
            $table->dropForeign(['destination_sector_id']);
            $table->dropColumn('destination_sector_id');
            $table->enum('status', ['active', 'on_standby', 'engaged', 'docked', 'destroyed'])->default('active')->change();
            $table->dropColumn('departure_time');
            $table->dropColumn('arrival_time');
        });
    }
};
