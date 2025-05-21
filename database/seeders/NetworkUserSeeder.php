<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Network;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NetworkUserSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('network_user')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $users = User::all();
        $networks = Network::all();

        foreach ($users as $user) {
            $usedNetworks = $networks->random(rand(1, 3));

            foreach ($usedNetworks as $network) {
                $username = fake()->userName();
                $profileUrl = rtrim($network->site, '/') . '/' . $username;

                $user->networks()->attach($network->id, [
                    'url' => $profileUrl,
                ]);
            }
        }
    }
}
