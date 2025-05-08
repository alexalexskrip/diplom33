<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProjectMedia>
 */
class ProjectMediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws \Exception
     */
    public function definition(): array
    {
        $filename = uniqid('project_').Str::uuid().'.jpg';
        $filepath = public_path('storage/projectmedia/'.$filename);

        // Скачиваем реальное изображение с Picsum с повторной попыткой при ошибке
        $attempts = 3;
        $imageContent = false;
        while ($attempts--) {
            $imageContent = @file_get_contents('https://picsum.photos/640/480?random='.uniqid());
            if ($imageContent !== false) {
                break;
            }
            sleep(1);
        }

        if ($imageContent === false) {
            throw new \Exception('Не удалось загрузить изображение с picsum.photos');
        }

        file_put_contents($filepath, $imageContent);

        return [
            'Id_project' => Project::query()->inRandomOrder()->value('id') ?? Project::factory(),
            'File_ProjectMedia' => $filename,
            'NumFile_ProjectMedia' => 0, // будет переопределено в сидере
        ];
    }
}
