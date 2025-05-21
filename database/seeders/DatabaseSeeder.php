<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            RoleSeeder::class,
            StatusSeeder::class,
            NetworkSeeder::class,
            SourceSeeder::class,
            UniversitySeeder::class,
            FacultySeeder::class,
            CourseSeeder::class,
            GroupSeeder::class,
            ProjectSeeder::class,
            ProjectNewsSeeder::class,
            Artisan::call('seed:project-media'),
            UserSeeder::class,
            AdminSeeder::class,
            NetworkUserSeeder::class
        ]);
    }
}
