<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['name' => 'Admin',
            'email' => 'admin@test.com',
            'role' => 'admin',
            'venue' => '0',
            'primary_user' => 1,
            'cell' => '1234567890',
            'password' => Hash::make('ADMINpassword#1'),
            'is_active' => 1],
        ]);
    }
}


