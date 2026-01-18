<?php

namespace Database\Seeders;

use App\Models\Player;
use App\Models\TeamEvent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamEventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $eventId = 1;

        // Ambil semua player dan pastikan GENAP
        $playerIds = Player::orderBy('id')
            ->pluck('id')
            ->toArray();

        if (count($playerIds) % 2 !== 0) {
            throw new \Exception('Jumlah player harus genap untuk membentuk tim');
        }

        // Pasangkan 2 player per tim
        $teams = array_chunk($playerIds, 2);

        foreach ($teams as $index => $team) {
            TeamEvent::create([
                'first_player_id' => $team[0],
                'second_player_id' => $team[1],
                'event_id' => $eventId,
                'seed' => rand(1, 3),
            ]);
        }
    }
}
