<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->unsignedInteger('id_course')->change();

            $table->foreign('id_course')
                ->references('id')->on('courses')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->dropForeign(['id_course']);
            $table->unsignedBigInteger('id_course')->change();
        });
    }
};
