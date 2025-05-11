<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\SourceList;
use App\Models\StatusList;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('projects')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        if (StatusList::query()->count() === 0) {
            StatusList::factory(5)->create();
        }

        if (SourceList::query()->count() === 0) {
            SourceList::factory(10)->create();
        }

        Project::factory(10)->create()->each(function ($project) {
            $sourceIds = SourceList::query()->inRandomOrder()->take(rand(1, 3))->pluck('id');
            $project->sourceLists()->sync($sourceIds);
        });
    }
}
