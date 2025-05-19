<?php

namespace Database\Seeders;

use App\Models\Network;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NetworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('networks')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        Network::factory()->count(15)->create();
    }
}
