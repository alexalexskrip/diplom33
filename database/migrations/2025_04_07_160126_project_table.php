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
        Schema::create('project', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('id_status');
            $table->string('name_project', 255);
            $table->string('discription_project', 255);
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
        Schema::dropIfExists('project');
    }
};




/* 

$table->increments('id');
$table->foreignId('id_university');
$table->string('name_faculty', 255);    
$table->timestamps(); 
            
*/