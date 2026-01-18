<?php

namespace Database\Seeders;

use App\EventType;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $events = [
            [
                'title' => 'Padel Tournament Jakarta',
                'event_type' => EventType::CHAMPIONSHIP,
                'status' => 'published',
                'description' => 'Annual padel tournament for intermediate and professional players.',
                'image' => null,
                'start_time' => $now->copy()->addDays(10),
                'end_time' => $now->copy()->addDays(12),
                'location' => 'Jakarta Padel Club',
                'created_by' => 1,
                'max_participants' => 32,
                'max_group' => 0,
                'max_participants_in_group' => 0,
                'category' => 'sport',
                'prize_pool' => 50000000,
                'registration_deadline' => $now->copy()->addDays(7),
                'points_win' => 0,
                'points_lose' => 0,
            ],
            [
                'title' => 'Beginner Padel Workshop',
                'event_type' => EventType::LEAGUE,
                'status' => 'draft',
                'description' => 'Padel workshop for beginners with professional coach.',
                'image' => null,
                'start_time' => $now->copy()->addDays(5),
                'end_time' => $now->copy()->addDays(5)->addHours(4),
                'location' => 'Bandung Sports Center',
                'created_by' => 1,
                'max_participants' => 60,
                'max_group' => 10,
                'max_participants_in_group' => 6,
                'category' => 'training',
                'prize_pool' => 0,
                'registration_deadline' => $now->copy()->addDays(3),
                'points_win' => 3,
                'points_lose' => -1,
            ],
        ];

        foreach ($events as $event) {
            DB::table('events')->insert(array_merge($event, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
