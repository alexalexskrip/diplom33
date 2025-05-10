<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('projectnews', function (Blueprint $table) {
            $table->unsignedInteger('id_project')->change();
            $table->foreign('id_project')
                ->references('id')
                ->on('projects')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('projectnews', function (Blueprint $table) {
            $table->dropForeign(['id_project']);
        });
    }
};
