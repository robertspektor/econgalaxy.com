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
        Schema::create('utility_modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->constrained('modules')->onDelete('cascade'); // Link to the main modules table
            $table->string('effect'); // Primary effect of the utility module
            $table->integer('power_consumption'); // Power required for the module
            $table->integer('cooldown')->nullable(); // Cooldown period for active modules, if applicable
            $table->integer('duration')->nullable(); // Duration for time-limited effects
            $table->integer('range')->nullable(); // Effective range, if applicable
            $table->enum('utility_type', ['passive', 'active'])->default('passive'); // Type of utility effect
            $table->string('special_ability')->nullable(); // Special effect or ability description
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utility_modules');
    }
};
