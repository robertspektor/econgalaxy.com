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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('from'); // Absender (z. B. "Hegemony Command <h-com@core.gov>")
            $table->string('to')->nullable(); // Empfänger (z. B. "RIX INDUSTRIES HQ")
            $table->string('subject');
            $table->text('body');
            $table->string('channel')->nullable(); // Kommunikationskanal (z. B. "Encrypted [LEVEL 2]")
            $table->string('priority')->default('normal'); // Priorität (normal, high, critical)
            $table->string('folder')->default('inbox'); // Ordner (inbox, sent, archive, system, faction)
            $table->boolean('is_read')->default(false);
            $table->timestamp('received_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
