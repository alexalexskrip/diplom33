<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Group;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('groups')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        Course::all()->each(function ($course) {
            $count = rand(3, 5);

            for ($i = 0; $i < $count; $i++) {
                $group = Group::factory()->create(['course_id' => $course->id]);
                dump("Создана: {$group->name} (Курс ID: {$group->course_id})");
            }
        });
    }
}
