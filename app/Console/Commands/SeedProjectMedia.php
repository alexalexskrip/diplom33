<?php

namespace App\Console\Commands;

use App\Models\Project;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Console\Command\Command as CommandAlias;

class SeedProjectMedia extends Command
{
    protected $signature = 'seed:project-media {--only= : images, documents, videos, or leave empty for all}';

    protected $description = 'Генерирует медиа-файлы для проектов (изображения, документы, видео)';

    public function handle(): int
    {
        $type = $this->option('only');

        if (!in_array($type, ['images', 'documents', 'videos', null], true)) {
            $this->error("Неверный параметр --only={$type}. Допустимые значения: images, documents, videos.");
            return CommandAlias::FAILURE;
        }

        if (Project::count() === 0) {
            Project::factory()->count(3)->create();
        }

        foreach (Project::all() as $project) {
            if (!$type || $type === 'images') {
                $project->clearMediaCollection('images');
                for ($i = 0; $i < rand(1, 3); $i++) {
                    $filename = 'project_'.Str::uuid().'.jpg';
                    $url = 'https://picsum.photos/640/480?random=' . uniqid();
                    $imageContent = @file_get_contents($url);

                    if ($imageContent) {
                        $project->addMediaFromString($imageContent)
                            ->usingFileName($filename)
                            ->withCustomProperties(['position' => $i])
                            ->toMediaCollection('images');
                    }
                }
            }

            if (!$type || $type === 'documents') {
                $project->clearMediaCollection('documents');

                $project->addMediaFromString("Это тестовый документ для проекта ID {$project->id}.")
                    ->usingFileName("description_{$project->id}.txt")
                    ->toMediaCollection('documents');

                $pdfUrl = 'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf';
                $pdfContent = @file_get_contents($pdfUrl);
                if ($pdfContent) {
                    $project->addMediaFromString($pdfContent)
                        ->usingFileName("file_{$project->id}.pdf")
                        ->toMediaCollection('documents');
                }

                $docxUrl = 'https://file-examples.com/storage/fe81be7a5f596d3dfd8c91d/2017/02/file-sample_100kB.docx';
                $docxContent = @file_get_contents($docxUrl);
                if ($docxContent) {
                    $project->addMediaFromString($docxContent)
                        ->usingFileName("file_{$project->id}.docx")
                        ->toMediaCollection('documents');
                }
            }

            if (!$type || $type === 'videos') {
                $project->clearMediaCollection('videos');

                $videoUrl = 'https://samplelib.com/lib/preview/mp4/sample-10s.mp4';
                $videoContent = @file_get_contents($videoUrl);

                if ($videoContent) {
                    $project->addMediaFromString($videoContent)
                        ->usingFileName('sample_'.Str::uuid().'.mp4')
                        ->toMediaCollection('videos');
                }
            }
        }

        $this->info("Медиа для проектов сгенерированы успешно." . ($type ? " Тип: {$type}" : ''));
        return CommandAlias::SUCCESS;
    }
}
