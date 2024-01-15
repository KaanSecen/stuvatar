<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Seed 20 grades
        \App\Models\Grade::factory(10)->create();

        // Seed 20 Categories
        \App\Models\Category::factory(2)->create();

        // Seed 200 Items
        \App\Models\Item::factory(200)->create();

        // Seed 750 students using the factory
        \App\Models\Student::factory(50)->create();

        \App\Models\ItemStudent::factory(25)->create();

        \App\Models\Chest::factory(5)->create();

        \App\Models\ItemChest::factory(200)->create();

    }
}
