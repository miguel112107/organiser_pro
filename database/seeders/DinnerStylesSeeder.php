<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DinnerStylesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dinner_styles')->insert([
            ['style' => 'Buffet'],
            ['style' => 'Plated'],
            ['style' => 'Family'],
            ['style' => 'Outside Caterer']
        ]);
    }
}
