<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('student_projects', function (Blueprint $table) {
            // Удаляем первичный ключ с поля id
            $table->dropPrimary();

            // Удаляем поле id
            $table->dropColumn('id');

            // Назначаем составной первичный ключ
            $table->primary(['id_user', 'id_project']);
        });
    }

    public function down(): void
    {
        Schema::table('student_projects', function (Blueprint $table) {
            $table->bigIncrements('id')->first();
            $table->dropPrimary();
            $table->primary('id');
        });
    }
};
