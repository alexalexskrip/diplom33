<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('faculties', function (Blueprint $table) {
            // Обязательно: изменить тип, чтобы он совпадал с universities.id (int unsigned)
            $table->unsignedInteger('id_university')->change();

            // Добавить внешний ключ
            $table->foreign('id_university')
                ->references('id')
                ->on('universities')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('faculties', function (Blueprint $table) {
            $table->dropForeign(['id_university']);

            // Откат — если нужно вернуть bigint
            $table->unsignedBigInteger('id_university')->change();
        });
    }
};

