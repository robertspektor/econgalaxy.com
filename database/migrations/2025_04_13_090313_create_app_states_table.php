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
        Schema::create('app_states', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Verknüpfung mit dem Benutzer
            $table->string('app_name'); // Name der App (z. B. 'profileManager')
            $table->boolean('opened')->default(false); // Ist die App geöffnet?
            $table->boolean('minimized')->default(false); // Ist die App minimiert?
            $table->json('position'); // Position des Fensters (x, y)
            $table->json('size'); // Größe des Fensters (width, height)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_states');
    }
};
