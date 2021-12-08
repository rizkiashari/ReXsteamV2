<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'idle',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('categories')->insert([
            'name' => 'Horor',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('categories')->insert([
            'name' => 'Adventure',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('categories')->insert([
            'name' => 'Action',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('categories')->insert([
            'name' => 'Sports',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('categories')->insert([
            'name' => 'Strategy',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('categories')->insert([
            'name' => 'Role-Playing',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('categories')->insert([
            'name' => 'Puzzle',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('categories')->insert([
            'name' => 'Simulation',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
