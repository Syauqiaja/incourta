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
        // menyimpan nilai final score dari sebuah pertandingan
        Schema::create('fixture_scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fixture_id')->constrained('fixtures')->cascadeOnDelete();

            $table->string('source')->default('referee');
            $table->integer('first_team_score')->nullable();
            $table->integer('second_team_score')->nullable();

            $table->foreignId('winner_team_id')->nullable()->constrained('team_events')->nullOnDelete();
            $table->boolean('is_final')->default(false);
            $table->timestamp('finalized_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fixture_scores');
    }
};
