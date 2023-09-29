<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArchivesTable extends Migration
{
    
    public function up()
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('model');
            $table->bigInteger('data_id');
            $table->timestamps();
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('archives');
    }
}
