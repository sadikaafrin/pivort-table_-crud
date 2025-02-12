<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VersionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('versions')->insert([
            ['name' => 'Version 1.0', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Version 1.1', 'status' => 'inactive', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Version 2.0', 'status' => 'active', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}