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
        // Удалим старые изображения с диска вручную
        foreach (ProjectMedia::all() as $media) {
            Storage::disk('public')->delete("projectmedia/{$media->File_ProjectMedia}");
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('project_media')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        if (Project::query()->count() === 0) {
            Project::factory()->count(1)->create();
        }

        Storage::disk('public')->makeDirectory('projectmedia');

        // Добавим к каждому проекту случайное количество изображений от 1 до 4
        foreach (Project::all() as $project) {
            $count = rand(1, 4);
            for ($i = 1; $i < $count; $i++) {
                ProjectMedia::factory()->create([
                    'Id_project' => $project->id,
                    'NumFile_ProjectMedia' => $i
                ]);
            }
        }
    }
}
