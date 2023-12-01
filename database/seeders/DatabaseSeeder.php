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
        \App\Models\Grade::factory(20)->create();

        // Seed 20 Categories
        \App\Models\Category::factory(20)->create();

        // Seed 20 Items
        \App\Models\Item::factory(20)->create();

        // Seed 750 students using the factory
        \App\Models\Student::factory(750)->create();
    }
}
