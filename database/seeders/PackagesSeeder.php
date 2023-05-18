<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('packages')->insert([
            ['name' => 'Package 1'],
            ['name' => 'Package 2'],
            ['name' => 'Package 2R'],
            ['name' => 'Package 3']
        ]);
    }
}
