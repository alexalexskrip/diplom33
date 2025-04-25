<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->unsignedInteger('id_faculty')->change();

            $table->foreign('id_faculty')
                ->references('id')->on('faculties')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropForeign(['id_faculty']);

            $table->unsignedBigInteger('id_faculty')->change();
        });
    }
};
