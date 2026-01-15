<?php

use App\EventType;
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
        Schema::create('fixtures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete();
            $table->string('event_type')->default('championship')->index();
            $table->foreignId('group_id')->nullable()->constrained()->nullOnDelete();
            $table->string('round_name')->nullable(); // Quarter Final, Semi Final
            $table->foreignId('first_team_id')->constrained('team_events')->cascadeOnDelete();
            $table->foreignId('second_team_id')->constrained('team_events')->cascadeOnDelete();
            $table->foreignId('winner_team_id')->nullable()->constrained('team_events')->nullOnDelete();
            $table->string('scoring_type')->default('americano')->index();
            $table->string('status')->default('scheduled')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fixtures');
    }
};
