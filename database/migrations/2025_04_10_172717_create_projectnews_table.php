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
        Schema::create('projectnews', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('id_project');
            $table->date('date_projectnews');
            $table->string('name_projectnews');
            $table->string('discription_projectnews');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projectnews');
    }
};
