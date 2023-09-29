<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
     
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('employee_id')->unique();
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('birthdate')->nullable();
            $table->unsignedBigInteger('media_id')->nullable();
            $table->text('address')->nullable();
            $table->enum('gender',['Male','Female','Other'])->nullable();
            $table->text('remark')->nullable();
            $table->unsignedBigInteger('position_id')->nullable();
            $table->foreign('position_id')
                            ->references('id')
                            ->on('positions')
                            ->onDelete('cascade');
            $table->unsignedBigInteger('schedule_id')->nullable();
                            $table->foreign('schedule_id')
                            ->references('id')
                            ->on('schedules')
                            ->onDelete('cascade');
            $table->decimal('rate_per_hour',8,2)->default(0);
            $table->decimal('salary',8,2)->comment("It's just for information purpose.")->default(0);
            $table->boolean('is_active')->default(false);
            $table->softDeletes();
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
        Schema::dropIfExists('employees');
    }
}
