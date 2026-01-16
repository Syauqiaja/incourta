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
        Schema::create('standings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->cascadeOnDelete();
            $table->foreignId('group_id')->nullable()->constrained('groups')->cascadeOnDelete();
            $table->foreignId('team_event_id')->constrained('team_events')->cascadeOnDelete();

            $table->integer('played')->default(0);
            $table->integer('win')->default(0);
            $table->integer('lose')->default(0);
            $table->integer('points')->default(0);

            $table->integer('sets_for')->default(0);
            $table->integer('sets_against')->default(0);
            $table->integer('sets_diff')->default(0);

            $table->timestamps();

            $table->unique(['event_id', 'group_id', 'team_event_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('standings');
    }
};
