<?php

namespace Database\Seeders;

use App\Models\Player;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['beginner', 'intermediate', 'pro'];
        $cities = ['Jakarta', 'Bandung', 'Surabaya', 'Bali'];
        for ($i = 1; $i <= 32; $i++) {
            $user = User::factory()->create(['password' => Hash::make('password')]);
            $user->assignRole('user');
            $player = Player::create([
                'user_id' => $user->id,
                'phone_number' => '08' . rand(1000000000, 9999999999),
                'city' => $cities[array_rand($cities)],
                'category' => $categories[array_rand($categories)],
                'nik' => rand(3200000000000000, 3299999999999999),
                'instagram' => '@player' . rand(1000, 9999),
                'reclub' => 'Padel Club ' . rand(1, 10),
            ]);
        }
    }
}
