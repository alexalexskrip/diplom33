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
        Schema::create('project_news', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('date');
            $table->string('name', 255);
            $table->string('slug', 255)->unique(); 
            $table->string('description', 255);
            $table->text('text');
            $table->timestamps();
            
        });
    }

    /*
    	`Id_ProjectNews` INT(11) NOT NULL AUTO_INCREMENT,
	`Date_ProjectNews` DATE NOT NULL,
	`Name_ProjectNews` VARCHAR(50) NOT NULL,
	`Discription_ProjectNews` TEXT NOT NULL,
	PRIMARY KEY (`Id_ProjectNews`)


    $table->increments('id');
            $table->integer('work_id')->unsigned();
            $table->string('name', 55);
            $table->string('slug', 55);
            $table->string('value', 55);
            $table->float('brigade_price')->nullable();
     */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_news');
    }
};
