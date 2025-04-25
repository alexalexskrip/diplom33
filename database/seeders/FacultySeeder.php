<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\University;
use App\Models\Faculty;

class FacultySeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            'Информационные технологии',
            'Гуманитарные науки',
            'Экономика и управление',
            'Физико-математические науки',
            'Право',
            'Психология',
            'Иностранные языки',
            'Медицина',
            'Архитектура и дизайн',
            'Педагогика и образование',
        ];

        // Для каждого университета создаём 10 факультетов
        University::all()->each(function ($university) use ($names) {
            foreach ($names as $name) {
                Faculty::create([
                    'id_university' => $university->id,
                    'name_faculty' => $name,
                ]);
            }
        });
    }
}

