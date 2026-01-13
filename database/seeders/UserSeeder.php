<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::get();
        if ($users->count() <= 0) {
            $superadmin = User::factory()->create(['password' => Hash::make('password')]);
            $superadmin->assignRole('superadmin');
            $admin = User::factory()->create(['password' => Hash::make('password')]);
            $admin->assignRole('admin');
            $user = User::factory()->create(['password' => Hash::make('password')]);
            $user->assignRole('user');
        }
    }
}
