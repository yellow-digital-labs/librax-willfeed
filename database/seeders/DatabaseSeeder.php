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

        \App\Models\MainActivity::truncate();
        DB::table('main_activities')->insert([
            'name' => 'Deposito diretto raffineria',
        ]);
        DB::table('main_activities')->insert([
            'name' => 'Deposito privato',
        ]);
        DB::table('main_activities')->insert([
            'name' => 'Agenzia',
        ]);

        \App\Models\StorageCapacity::truncate();
        DB::table('storage_capacities')->insert([
            'name' => '< 50.000 Litri',
        ]);
        DB::table('storage_capacities')->insert([
            'name' => 'Da 50.000 a 100.000 Litri',
        ]);
        DB::table('storage_capacities')->insert([
            'name' => 'Oltre i 100.000 Litri',
        ]);

        \App\Models\OrderCapacity::truncate();
        DB::table('order_capacities')->insert([
            'name' => '< 50.000 Litri',
        ]);
        DB::table('order_capacities')->insert([
            'name' => 'Da 50.000 a 100.000 Litri',
        ]);
        DB::table('order_capacities')->insert([
            'name' => 'Oltre i 100.000 Litri',
        ]);

        \App\Models\Product::truncate();
        DB::table('products')->insert([
            'name' => 'Gasolio',
            'active' => 'yes'
        ]);
        DB::table('products')->insert([
            'name' => 'SSP',
            'active' => 'yes'
        ]);
        DB::table('products')->insert([
            'name' => 'ADblue',
            'active' => 'yes'
        ]);
        DB::table('products')->insert([
            'name' => 'Gasolio Agricolo',
            'active' => 'yes'
        ]);
        DB::table('products')->insert([
            'name' => 'OCD BTZ',
            'active' => 'yes'
        ]);

        \App\Models\Common::truncate();
        DB::table('commons')->insert([
            'name' => 'Common 1'
        ]);
        DB::table('commons')->insert([
            'name' => 'Common 2'
        ]);
        DB::table('commons')->insert([
            'name' => 'Common 3'
        ]);

        \App\Models\Province::truncate();
        DB::table('provinces')->insert([
            'commons_id' => 1,
            'name' => 'Common 1 Provinces 1'
        ]);
        DB::table('provinces')->insert([
            'commons_id' => 1,
            'name' => 'Common 1 Provinces 2'
        ]);
        DB::table('provinces')->insert([
            'commons_id' => 2,
            'name' => 'Common 2 Provinces 1'
        ]);
        DB::table('provinces')->insert([
            'commons_id' => 2,
            'name' => 'Common 2 Provinces 2'
        ]);
        DB::table('provinces')->insert([
            'commons_id' => 2,
            'name' => 'Common 2 Provinces 3'
        ]);
        DB::table('provinces')->insert([
            'commons_id' => 3,
            'name' => 'Common 3 Provinces 2'
        ]);
        DB::table('provinces')->insert([
            'commons_id' => 3,
            'name' => 'Common 3 Provinces 1'
        ]);

        \App\Models\Region::truncate();
        DB::table('regions')->insert([
            'name' => 'Region 1'
        ]);
        DB::table('regions')->insert([
            'name' => 'Region 2'
        ]);
        DB::table('regions')->insert([
            'name' => 'Region 3'
        ]);
    }
}
