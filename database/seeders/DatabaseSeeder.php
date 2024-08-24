<?php

namespace Database\Seeders;

use App\Models\Job;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Job::create([
            'name' => 'Student',
        ]);
        Job::create([
            'name' => 'Teacher',
        ]);
        Job::create([
            'name' => 'Entrepreneur',
        ]);
        Job::create([
            'name' => 'Others',
        ]);
    }
}
