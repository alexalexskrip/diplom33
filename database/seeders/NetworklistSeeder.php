<?php

namespace Database\Seeders;

use App\Models\Networklist;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NetworklistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('networklists')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        Networklist::factory()->count(15)->create();
    }
}
