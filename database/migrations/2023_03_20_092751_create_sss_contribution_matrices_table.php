<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSssContributionMatricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sss_contribution_matrices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('range_from',16,2);
            $table->decimal('range_to',16,2);
            $table->decimal('value',16,2);
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
        Schema::dropIfExists('sss_contribution_matrices');
    }
}
