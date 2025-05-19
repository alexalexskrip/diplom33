<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Убедимся, что роль admin существует
        $role = Role::query()->firstOrCreate(['name' => 'admin']);

        // Создаём пользователя-админа (если нет)
        $admin = User::firstOrCreate(
            ['email' => 'test@test.test'],
            [
                'name' => 'Администратор',
                'email_verified_at' => now(),
                'password' => Hash::make('123456789'), // замени на безопасный
            ]
        );

        // Назначаем роль
        $admin->assignRole($role);
    }
}
