<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\University;
use App\Models\Faculty;
use Illuminate\Support\Facades\DB;

class FacultySeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('faculties')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

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
                    'university_id' => $university->id,
                    'name' => $name,
                ]);
            }
        });
    }
}

