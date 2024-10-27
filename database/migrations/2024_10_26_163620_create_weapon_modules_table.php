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
        Schema::create('weapon_modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('module_id')->constrained('modules')->onDelete('cascade');
            $table->integer('primary_damage');
            $table->string('primary_type');
            $table->integer('secondary_damage')->nullable();
            $table->string('secondary_type')->nullable();
            $table->integer('range');
            $table->integer('accuracy');
            $table->integer('cooldown');
            $table->string('special_ability')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weapon_modules');
    }
};
