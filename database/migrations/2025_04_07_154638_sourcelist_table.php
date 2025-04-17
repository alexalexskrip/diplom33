<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('sourcelist',function(blueprint $table){
            $table->increments('id');
            $table->string('name_sourcelist',50);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sourcelist');
    }
};
