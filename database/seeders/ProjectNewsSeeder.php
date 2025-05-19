<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectNews;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectNewsSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        ProjectNews::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        if (Project::query()->count() === 0) {
            Project::factory()->count(1)->create();
        }

        ProjectNews::factory()->count(20)->create();
    }
}
