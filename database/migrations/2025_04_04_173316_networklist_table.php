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
        Schema::create('networklist', function (Blueprint $table){  
        
            $table->increments('id');
            $table->string('name_networkList', 50);
            $table->string('site_netWWorklist', 50);    
            $table->timestamps();
        
        /*
            CREATE TABLE `networklist` (
  `Id_NetworkList` int NOT NULL AUTO_INCREMENT,
  `Name_NetworkList` varchar(50) NOT NULL,
  `Site_NetWWorklist` varchar(50) NOT NULL,
  PRIMARY KEY (`Id_NetworkList`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COMMENT='NetworkList'
        */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    
            Schema::dropIfExists('networklist');
    
    }
};
