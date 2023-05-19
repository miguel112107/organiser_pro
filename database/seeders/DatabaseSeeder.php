<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Seeder;
  
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersSeeder::class,
            BarPlansSeeder::class,
            DinnerStylesSeeder::class,
            LinenChoicesSeeder::class,
            LocationsSeeder::class,
            PackagesSeeder::class,
            TableLayoutsSeeder::class
        ]);
    }
}