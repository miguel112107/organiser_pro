<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LinenChoicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('linen_choices')->insert([
            ['color' => 'Black'],
            ['color' => 'Navy Blue'],
            ['color' => 'Cream'],
            ['color' => 'Blush Rose'],
            ['color' => 'You will provide']
        ]);
    }
}
