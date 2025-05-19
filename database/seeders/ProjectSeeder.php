<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Source;
use App\Models\Status;
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
        Project::query()->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        if (Status::query()->count() === 0) {
            Status::factory(5)->create();
        }

        if (Source::query()->count() === 0) {
            Source::factory(10)->create();
        }

        Project::factory(10)->create()->each(function ($project) {
            $sourceIds = Source::query()->inRandomOrder()->take(rand(1, 3))->pluck('id');
            $project->sources()->sync($sourceIds);
        });
    }
}
