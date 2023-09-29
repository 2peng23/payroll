<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeDeductionsTable extends Migration
{
   
    public function up()
    {
        Schema::create('employee_deductions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('deduction_id');
            $table->foreign('employee_id')->references('id')
                ->on('employees')
                ->onDelete('cascade');
                $table->foreign('deduction_id')->references('id')
                ->on('deductions')
                ->onDelete('cascade');
                $table->decimal('custom',16,2)->nullable();
                 
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
        Schema::dropIfExists('employee_deductions');
    }
}
