<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement('RENAME TABLE university TO universities');
        DB::statement('RENAME TABLE faculty TO faculties');
        DB::statement('RENAME TABLE course TO courses');
        DB::statement('RENAME TABLE `group` TO `groups`');
        DB::statement('RENAME TABLE networklist TO networklists');
        DB::statement('RENAME TABLE project TO projects');
        DB::statement('RENAME TABLE projectsourcelist TO project_source_lists');
        DB::statement('RENAME TABLE sourcelist TO source_lists');
        DB::statement('RENAME TABLE statuslist TO status_lists');
        DB::statement('RENAME TABLE student TO students');
        DB::statement('RENAME TABLE studentnetwork TO student_networks');
        DB::statement('RENAME TABLE studentproject TO student_projects');
    }

    public function down(): void
    {
        DB::statement('RENAME TABLE universities TO university');
        DB::statement('RENAME TABLE faculties TO faculty');
        DB::statement('RENAME TABLE courses TO course');
        DB::statement('RENAME TABLE `groups` TO `group`');
        DB::statement('RENAME TABLE networklists TO networklist');
        DB::statement('RENAME TABLE projects TO project');
        DB::statement('RENAME TABLE project_source_lists TO projectsourcelist');
        DB::statement('RENAME TABLE source_lists TO sourcelist');
        DB::statement('RENAME TABLE status_lists TO statuslist');
        DB::statement('RENAME TABLE students TO student');
        DB::statement('RENAME TABLE student_networks TO studentnetwork');
        DB::statement('RENAME TABLE student_projects TO studentproject');
    }
};

