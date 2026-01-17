<?php

use App\Enums\EventStatus;
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
        Schema::table('events', function (Blueprint $table) {
            $table->string('status')->comment(\json_encode(EventStatus::cases()))->default(EventStatus::DRAFT->value)->after('event_type');
            $table->string('prize_pool')->nullable()->after('description');
            $table->dateTime('registration_deadline')->nullable()->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['prize_pool', 'status',  'registration_deadline']);
        });
    }
};
