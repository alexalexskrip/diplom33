<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $tables = [
            'networklists', 'source_lists',

            'projectnews' => ['id_project' => 'projects'],
            'projects' => ['id_status' => 'status_lists'],
            'student_projects' => [
                'id_student' => 'students',
                'id_project' => 'projects'
            ],
            'courses' => ['id_faculty' => 'faculties'],
            'groups' => ['id_course' => 'courses'],
            'faculties' => ['id_university' => 'universities'],
            'universities' => [],

            'students' => ['id_group' => 'groups'],
            'student_networks' => [
                'id_student' => 'students',
                'id_networklist' => 'networklists'
            ],
            'project_media' => ['Id_project' => 'projects'],
            'project_source_lists' => [
                'id_project' => 'projects',
                'id_sourcelist' => 'source_lists'
            ],
        ];

        // === 1. Удаляем внешние ключи и меняем типы ===
        foreach ($tables as $table => $foreigns) {
            if (is_int($table)) {
                $table = $foreigns;
                $foreigns = [];
            }

            // Удаление внешних ключей
            if (!empty($foreigns)) {
                Schema::table($table, function (Blueprint $tableBlueprint) use ($table, $foreigns) {
                    foreach ($foreigns as $column => $referenceTable) {
                        try {
                            DB::statement("ALTER TABLE `{$table}` DROP FOREIGN KEY `{$table}_{$column}_foreign`");
                        } catch (\Throwable $e) {}
                    }
                });
            }

            // Изменение id и внешних ключей
            Schema::table($table, function (Blueprint $tableBlueprint) use ($foreigns) {
                try { $tableBlueprint->unsignedBigInteger('id')->change(); } catch (\Throwable $e) {}

                foreach ($foreigns as $column => $referenceTable) {
                    try {
                        $tableBlueprint->unsignedBigInteger($column)->change();
                    } catch (\Throwable $e) {}
                }
            });
        }

        // Статус лист обрабатывается отдельно, т.к. он referenced
        Schema::table('status_lists', function (Blueprint $table) {
            try { $table->unsignedBigInteger('id')->change(); } catch (\Throwable $e) {}
        });

        // === 2. Повторно добавляем внешние ключи ===
        foreach ($tables as $table => $foreigns) {
            if (is_int($table)) {
                continue; // у этих таблиц нет внешних ключей
            }

            Schema::table($table, function (Blueprint $tableBlueprint) use ($foreigns) {
                foreach ($foreigns as $column => $referenceTable) {
                    try {
                        $tableBlueprint->foreign($column)->references('id')->on($referenceTable)->onDelete('cascade');
                    } catch (\Throwable $e) {}
                }
            });
        }
    }

    public function down(): void
    {
        // projects
        Schema::table('projects', function (Blueprint $table) {
            try { DB::statement('ALTER TABLE projects DROP FOREIGN KEY projects_id_status_foreign'); } catch (\Throwable $e) {}
            $table->unsignedInteger('id_status')->change();
        });

        // project_media
        Schema::table('project_media', function (Blueprint $table) {
            try { DB::statement('ALTER TABLE project_media DROP FOREIGN KEY project_media_Id_project_foreign'); } catch (\Throwable $e) {}
            $table->unsignedInteger('Id_project')->change();
        });

        // faculties
        Schema::table('faculties', function (Blueprint $table) {
            try { DB::statement('ALTER TABLE faculties DROP FOREIGN KEY faculties_id_university_foreign'); } catch (\Throwable $e) {}
            $table->unsignedInteger('id_university')->change();
        });

        // courses
        Schema::table('courses', function (Blueprint $table) {
            try { DB::statement('ALTER TABLE courses DROP FOREIGN KEY courses_id_faculty_foreign'); } catch (\Throwable $e) {}
            try { DB::statement('ALTER TABLE courses DROP FOREIGN KEY courses_id_university_foreign'); } catch (\Throwable $e) {}
            $table->unsignedInteger('id_faculty')->change();
            $table->unsignedInteger('id_university')->change();
        });

        // groups
        Schema::table('groups', function (Blueprint $table) {
            try { DB::statement('ALTER TABLE groups DROP FOREIGN KEY groups_id_course_foreign'); } catch (\Throwable $e) {}
            $table->unsignedInteger('id_course')->change();
        });

        // students
        Schema::table('students', function (Blueprint $table) {
            try { DB::statement('ALTER TABLE students DROP FOREIGN KEY students_id_group_foreign'); } catch (\Throwable $e) {}
            $table->unsignedInteger('id_group')->change();
        });

        // student_projects
        Schema::table('student_projects', function (Blueprint $table) {
            try { DB::statement('ALTER TABLE student_projects DROP FOREIGN KEY student_projects_id_student_foreign'); } catch (\Throwable $e) {}
            try { DB::statement('ALTER TABLE student_projects DROP FOREIGN KEY student_projects_id_project_foreign'); } catch (\Throwable $e) {}
            $table->unsignedInteger('id_student')->change();
            $table->unsignedInteger('id_project')->change();
        });

        // student_networks
        Schema::table('student_networks', function (Blueprint $table) {
            try { DB::statement('ALTER TABLE student_networks DROP FOREIGN KEY student_networks_id_student_foreign'); } catch (\Throwable $e) {}
            try { DB::statement('ALTER TABLE student_networks DROP FOREIGN KEY student_networks_id_networklist_foreign'); } catch (\Throwable $e) {}
            $table->unsignedInteger('id_student')->change();
            $table->unsignedInteger('id_networklist')->change();
        });

        // projectnews
        Schema::table('projectnews', function (Blueprint $table) {
            try { DB::statement('ALTER TABLE projectnews DROP FOREIGN KEY projectnews_id_project_foreign'); } catch (\Throwable $e) {}
            $table->unsignedInteger('id_project')->change();
        });

        // project_source_lists
        Schema::table('project_source_lists', function (Blueprint $table) {
            try { DB::statement('ALTER TABLE project_source_lists DROP FOREIGN KEY project_source_lists_id_project_foreign'); } catch (\Throwable $e) {}
            try { DB::statement('ALTER TABLE project_source_lists DROP FOREIGN KEY project_source_lists_id_sourcelist_foreign'); } catch (\Throwable $e) {}
            $table->unsignedInteger('id_project')->change();
            $table->unsignedInteger('id_sourcelist')->change();
        });
    }
};
