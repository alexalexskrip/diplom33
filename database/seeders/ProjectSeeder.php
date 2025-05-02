<?php

namespace Database\Seeders;

use App\Models\Project;
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
            StatusList::factory()->count(5)->create();
        }

        Project::factory()->count(10)->create();
    }
}
