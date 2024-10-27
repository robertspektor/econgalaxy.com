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
        Schema::create('jump_gates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sector_id')->constrained();
            $table->foreignId('target_sector_id')->constrained('sectors');
            $table->integer('x');
            $table->integer('y');
            $table->integer('distance');

            $table->foreignId('target_jump_gate_id')
                ->nullable()
                ->constrained('jump_gates');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jump_gates');
    }
};
