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
        \App\Models\AccountType::truncate();
        DB::table('account_types')->insert([
            'name' => 'Cliente',
        ]);
        DB::table('account_types')->insert([
            'name' => 'Venditore/Agenzia',
        ]);
    }
}
