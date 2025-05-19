<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectMedia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Storage;

class ProjectMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Удаляем старые изображения с диска
        foreach (ProjectMedia::all() as $media) {
            Storage::disk('public')->delete("projectmedia/{$media->file_path}");
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('project_media')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        if (Project::query()->count() === 0) {
            Project::factory()->count(1)->create();
        }

        Storage::disk('public')->makeDirectory('projectmedia');

        foreach (Project::all() as $project) {
            $count = rand(1, 4);
            for ($i = 0; $i < $count; $i++) {
                ProjectMedia::factory()->create([
                    'project_id' => $project->id,
                    'position' => $i
                ]);
            }
        }
    }
}
