<?php

namespace Database\Seeders;

use App\Models\StatusList;
use DB;
use Illuminate\Database\Seeder;

class StatusListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('status_lists')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        foreach ([
                     'Новая заявка',
                     'В работе',
                     'На доработке',
                     'На проверке',
                     'Принята',
                     'Отклонена',
                     'Архив',
                     'Завершена',
                     'Ожидает ответа',
                     'Отложена'
                 ] as $status) {
            StatusList::query()->create(['namesource_net' => $status]);
        }
    }
}
