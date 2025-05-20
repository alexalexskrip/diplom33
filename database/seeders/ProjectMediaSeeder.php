<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectMediaSeeder extends Seeder
{
    public function run(): void
    {
        if (Project::count() === 0) {
            Project::factory()->count(3)->create();
        }

        foreach (Project::all() as $project) {
            $project->clearMediaCollection('images');
            $project->clearMediaCollection('documents');
            $project->clearMediaCollection('videos');

            // Добавим изображения (Picsum)
            for ($i = 0; $i < rand(1, 3); $i++) {
                $filename = 'project_'.Str::uuid().'.jpg';
                $url = 'https://picsum.photos/640/480?random='.uniqid();
                $imageContent = @file_get_contents($url);

                if ($imageContent) {
                    $project->addMediaFromString($imageContent)
                        ->usingFileName($filename)
                        ->withCustomProperties(['position' => $i])
                        ->toMediaCollection('images');
                }
            }

            // Добавим текстовый файл (документ)
            $project->addMediaFromString("Это тестовый документ для проекта ID {$project->id}.")
                ->usingFileName("description_{$project->id}.txt")
                ->toMediaCollection('documents');

            // Добавим PDF-документ
            $pdfUrl = 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf';
            $pdfContent = @file_get_contents($pdfUrl);
            if ($pdfContent) {
                $project->addMediaFromString($pdfContent)
                    ->usingFileName("file_{$project->id}.pdf")
                    ->toMediaCollection('documents');
            }

            // Добавим DOCX-документ (если доступен)
            $docxUrl = 'https://file-examples.com/storage/fe81be7a5f596d3dfd8c91d/2017/02/file-sample_100kB.docx';
            $docxContent = @file_get_contents($docxUrl);
            if ($docxContent) {
                $project->addMediaFromString($docxContent)
                    ->usingFileName("file_{$project->id}.docx")
                    ->toMediaCollection('documents');
            }

            // Добавим видео (скачиваем из sample-videos.com)
            $videoUrl = 'https://sample-videos.com/video123/mp4/720/big_buck_bunny_720p_1mb.mp4';
            $videoContent = @file_get_contents($videoUrl);

            if ($videoContent) {
                $project->addMediaFromString($videoContent)
                    ->usingFileName('sample_'.Str::uuid().'.mp4')
                    ->toMediaCollection('videos');
            }
        }
    }
}
