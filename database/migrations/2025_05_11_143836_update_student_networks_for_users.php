<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('student_networks', function (Blueprint $table) {
            if (Schema::hasColumn('student_networks', 'id_student')) {
                $table->dropForeign(['id_student']);
                $table->renameColumn('id_student', 'id_user');
            }

            $table->foreign('id_user')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('student_networks', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->renameColumn('id_user', 'id_student');
            $table->foreign('id_student')
                ->references('id')
                ->on('students')
                ->onDelete('cascade');
        });
    }
};
