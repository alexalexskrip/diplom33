
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        
        Schema::create('faculty', function (Blueprint $table) {
            $table->increments('id');
            $table->foreignId('id_university');
            $table->string('name_faculty', 255);    
            $table->timestamps();
        
    });
}
    public function down()
    {
        Schema::dropIfExists('faculty');
    }
};

/*
Schema::create('project_news', function (Blueprint $table) {
    $table->increments('id');
    $table->dateTime('date');
    $table->string('name', 255);
    $table->string('slug', 255)->unique(); 
    $table->string('discription', 255);
    $table->text('text');
    $table->timestamps();
*/
