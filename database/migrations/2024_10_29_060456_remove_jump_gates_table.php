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
        Schema::dropIfExists('jump_gates');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('jump_gates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('system_id')->constrained('systems')->onDelete('cascade');
            $table->foreignId('target_system_id')->constrained('systems')->onDelete('cascade');
            $table->timestamps();
        });
    }
};
