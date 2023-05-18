<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TableLayoutsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('table_layouts')->insert([
            ['type' => 'Couple', 'layout'=> 'Sweetheart'],
            ['type' => 'Couple', 'layout'=> 'Head Tables'],
            ['type' => 'Couple', 'layout'=> 'King U Shape'],
            ['type' => 'Guest', 'layout'=> 'Herringbone (angled rows)'],
            ['type' => 'Guest', 'layout'=> 'Farm Style (long joined rows)'],
            ['type' => 'Guest', 'layout'=> 'Horizontal (sideways across)']
        ]);
    }
}
