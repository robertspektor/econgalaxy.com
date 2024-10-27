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
        Schema::create('propulsion_modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->constrained('modules')->onDelete('cascade');
            $table->enum('propulsion_type', ['impulse', 'warp', 'jump']);
            $table->integer('power_consumption');

            // Impulse Specific
            $table->decimal('max_speed', 8, 2)->nullable();
            $table->integer('acceleration')->nullable();

            // Warp Specific
            $table->integer('max_warp_factor')->nullable();
            $table->integer('warp_range')->nullable();

            // Jump Specific
            $table->integer('jump_range')->nullable();
            $table->integer('charge_time')->nullable();

            $table->integer('cooldown');
            $table->integer('stability')->default(100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('propulsion_modules');
    }
};
