<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(IndexesTableSeeder::class);
        $this->call([
            ServiceSeeder::class,
        ]);
        $this->call([
            AboutSeeder::class,
        ]);
        $this->call([
            ContactSeeder::class,
        ]);
        $this->call([
            ProductsPageSeeder::class,
        ]);
        $this->call([
            NewsPageSeeder::class,
        ]);
        $this->call([
            MediaPageSeeder::class,
        ]);
    }
}
