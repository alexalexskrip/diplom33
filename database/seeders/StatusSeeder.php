<?php

namespace Database\Seeders;

use App\Models\Status;
use DB;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('statuses')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        foreach ([
                     'На голосовании',
                     'На рассмотрении',
                     'Решение принято'
                 ] as $status) {
            Status::query()->create(['name' => $status]);
        }
    }
}
