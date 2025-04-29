<?php

namespace Database\Seeders;

use App\Models\SourceList;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SourceListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('source_lists')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        SourceList::factory()->count(15)->create();
    }
}
