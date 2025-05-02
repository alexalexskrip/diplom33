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
        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedInteger('id_status')->change();

            $table->foreign('id_status')
                ->references('id')
                ->on('status_lists')
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
        Schema::table('projects', function (Blueprint $table) {
            $table->dropForeign(['id_status']);
            $table->unsignedBigInteger('id_status')->change();
        });
    }
};
