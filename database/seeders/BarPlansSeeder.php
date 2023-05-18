<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarPlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bar_plans')->insert([
            ['plan' => 'Cash & credit only, guest purchase'],
            ['plan' => 'Limited prepaid open bar'],
            ['plan' => 'Full prepaid open bar'],
            ['plan' => 'Drink tokens']
        ]);
    }
}
