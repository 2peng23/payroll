<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHolidaysTable extends Migration
{
     public function up()
    {
        Schema::create('holidays', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->string('description');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('holidays');
    }
}
