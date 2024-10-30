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
        Schema::create('sectors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('system_id')->constrained('systems')->onDelete('cascade');
            $table->integer('ring_index'); // Index des Zonenrings (0 = innerster Ring)
            $table->integer('segment_index'); // Index des Segments innerhalb des Rings
            $table->integer('inner_radius'); // Berechneter innerer Radius des Rings
            $table->integer('outer_radius'); // Berechneter äußerer Radius des Rings
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sectors');
    }
};
