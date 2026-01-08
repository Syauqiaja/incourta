<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = ['superadmin', 'admin', 'user'];
        foreach ($data as $item) {
            Role::firstOrCreate(['name' => $item, 'guard_name' => 'web']);
        }
    }
}
