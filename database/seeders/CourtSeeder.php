<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $courts = [
            [
                'name' => 'Padel Court Pakuwon',
                'location' => 'Surabaya Barat',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Padel Court Citraland',
                'location' => 'Surabaya Barat',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Padel Court Galaxy',
                'location' => 'Surabaya Timur',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Padel Court Dharmahusada',
                'location' => 'Surabaya Timur',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Padel Court Tunjungan',
                'location' => 'Surabaya Pusat',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Padel Court Wonokromo',
                'location' => 'Surabaya Selatan',
                'is_active' => false,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Padel Court Kenjeran',
                'location' => 'Surabaya Utara',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Padel Court Rungkut',
                'location' => 'Surabaya Timur',
                'is_active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('courts')->insert($courts);
    }
}
