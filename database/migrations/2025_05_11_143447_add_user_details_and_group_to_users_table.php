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
        Schema::table('users', function (Blueprint $table) {
            $table->string('lastname', 50)->nullable();
            $table->string('firstname', 50)->nullable();
            $table->string('patronymic', 50)->nullable();
            $table->foreignId('id_group')->nullable()->constrained('groups')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['id_group']);
            $table->dropColumn(['lastname', 'firstname', 'patronymic', 'id_group']);
        });
    }
};
