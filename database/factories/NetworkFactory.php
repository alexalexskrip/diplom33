<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Network>
 */
class NetworkFactory extends Factory
{
    protected static int $index = 0;

    public function definition(): array
    {
        $socialNetworks = [
            ['name' => 'ВКонтакте', 'site' => 'https://vk.com'],
            ['name' => 'Одноклассники', 'site' => 'https://ok.ru'],
            ['name' => 'Телеграм', 'site' => 'https://t.me'],
            ['name' => 'Рутуб', 'site' => 'https://rutube.ru'],
            ['name' => 'Яндекс Дзэн', 'site' => 'https://dzen.ru'],
        ];

        if (self::$index >= count($socialNetworks)) {
            throw new \Exception('Попытка создать больше соцсетей, чем предусмотрено в фабрике NetworkFactory');
        }

        $data = $socialNetworks[self::$index];
        self::$index++;

        return [
            'name' => $data['name'],
            'site' => $data['site'],
        ];
    }
}
