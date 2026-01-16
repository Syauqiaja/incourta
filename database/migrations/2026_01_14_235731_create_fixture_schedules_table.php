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
        Schema::create('fixture_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fixture_id')->constrained('fixtures')->cascadeOnDelete();
            $table->foreignId('court_id')->nullable()->constrained('courts')->nullOnDelete();

            $table->date('scheduled_date');
            $table->time('scheduled_time');

            $table->timestamp('started_at')->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fixture_schedules');
    }
};
