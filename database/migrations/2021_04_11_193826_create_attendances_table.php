<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendancesTable extends Migration
{
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->time('time_in',0);
            $table->time('time_out',0)->default('00:00:00');
            $table->string('ampm')->nullable();
            $table->string('num_hour')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->string('ontime_status')->nullable();
            $table->foreign('employee_id')
                    ->references('id')
                    ->on('employees')
                    ->onDelete('cascade');
            $table->timestamps();
        });
    }
 
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
