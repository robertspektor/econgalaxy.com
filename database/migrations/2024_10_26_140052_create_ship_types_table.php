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
        Schema::create('ship_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description');
            $table->string('size'); // e.g., Small, Medium, Large, Capital
            $table->integer('weapon_slots')->default(0);
            $table->integer('defense_slots')->default(0);
            $table->integer('utility_slots')->default(0);
            $table->foreignId('mega_corporation_id')->constrained()->onDelete('cascade'); // Foreign key to the Megacorporation
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ship_types');
    }
};
