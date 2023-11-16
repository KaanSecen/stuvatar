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
        // Seed 10 grades
        \App\Models\Grade::factory(10)->create();

        // Seed 250 students using the factory
        \App\Models\Student::factory(250)->create();
    }
}
