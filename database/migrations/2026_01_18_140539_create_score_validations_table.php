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
        Schema::create('score_validations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fixture_id')->constrained('fixtures')->cascadeOnDelete();
            $table->foreignId('player_submission_id')->constrained('player_score_submissions')->cascadeOnDelete();

            $table->foreignId('validated_by')->constrained('users')->nullable()->nullOnDelete();
            $table->string('decision')->nullable();
            $table->text('note')->nullable();
            $table->timestamp('validated_at');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('score_validations');
    }
};
