<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Role::query()->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        Role::query()->firstOrCreate(['name' => 'admin']);
        Role::query()->firstOrCreate(['name' => 'teacher']);
        Role::query()->firstOrCreate(['name' => 'student']);
        Role::query()->firstOrCreate(['name' => 'moderator']);
    }
}
