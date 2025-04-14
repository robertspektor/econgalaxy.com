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
        Schema::create('travels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('origin_type', ['system', 'planet', 'moon']);
            $table->unsignedBigInteger('origin_id');
            $table->enum('destination_type', ['system', 'planet', 'moon']);
            $table->unsignedBigInteger('destination_id');
            $table->timestamp('started_at')->useCurrent();
            $table->timestamp('arrives_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travels');
    }
};
