<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('university',function(blueprint $table){
            $table->increments('id');
            $table->string ('name_university',50);
            $table->string ('adress_university',50);
            $table->integer ('phone_university');
            $table->string ('mail_university',50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('university');
    }
};