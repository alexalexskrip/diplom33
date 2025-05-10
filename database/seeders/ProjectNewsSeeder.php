<?php

namespace Database\Seeders;

use App\Models\ProjectNews;
use Illuminate\Database\Seeder;

class ProjectNewsSeeder extends Seeder
{
    public function run(): void
    {
        ProjectNews::factory()->count(20)->create();
    }
}
