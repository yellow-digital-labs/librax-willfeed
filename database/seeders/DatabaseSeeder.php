<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\UserType::truncate();
        DB::table('user_types')->insert([
            'name' => 'Cliente',
        ]);
        DB::table('user_types')->insert([
            'name' => 'Venditore/Agenzia',
        ]);
    }
}
