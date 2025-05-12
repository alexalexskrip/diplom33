<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('project_source_lists', function (Blueprint $table) {
            $table->dropPrimary();
            $table->dropColumn('id');
            $table->primary(['id_project', 'id_sourcelist']);
        });
    }

    public function down(): void
    {
        Schema::table('project_source_lists', function (Blueprint $table) {
            $table->bigIncrements('id')->first();
            $table->dropPrimary();
            $table->primary('id');
        });
    }
};
