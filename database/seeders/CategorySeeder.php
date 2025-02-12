<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Schema::disableForeignKeyConstraints();
         DB::table('categories')->truncate();
         Schema::enableForeignKeyConstraints();

         $categories = [
             ['name' => 'Technology', 'status' => 'active'],
             ['name' => 'Health', 'status' => 'active'],
             ['name' => 'Education', 'status' => 'inactive'],
             ['name' => 'Business', 'status' => 'active'],
             ['name' => 'Entertainment', 'status' => 'inactive'],
         ];

         DB::table('categories')->insert($categories);
    }
}