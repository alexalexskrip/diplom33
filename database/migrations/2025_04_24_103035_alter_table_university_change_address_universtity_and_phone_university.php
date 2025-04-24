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
    public function up()
    {
        Schema::table('university', function (Blueprint $table) {
            $table->string('adress_university', 255)->change();
        });

        Schema::table('university', function (Blueprint $table) {
            $table->renameColumn('adress_university', 'address_university');
            $table->string('phone_university', 20)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('university', function (Blueprint $table) {
            $table->renameColumn('address_university', 'adress_university');
        });

        Schema::table('university', function (Blueprint $table) {
            $table->string('adress_university', 50)->change();
        });
    }
};
