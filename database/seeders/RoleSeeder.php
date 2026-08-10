<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->updateOrInsert(
            ['id' => 1],
            ['role_name' => 'admin', 'description' => 'Administrator System', 'updated_at' => now()]
        );

        DB::table('roles')->updateOrInsert(
            ['id' => 2],
            ['role_name' => 'user', 'description' => 'Regular User', 'updated_at' => now()]
        );
    }
}