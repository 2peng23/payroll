<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFingerPrintsTable extends Migration
{ 
    public function up()
    {
        Schema::create('finger_prints', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('employee_id')->uninue();
            $table->string('finger');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('finger_prints');
    }
}
