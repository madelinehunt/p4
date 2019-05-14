<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('name');
            // $table->string('study_type');
            $table->enum('type', array('mturk', 'fMRI'));
            $table->bigInteger('accepted');
            $table->bigInteger('submitted');
            // $table->string('fund');
            $table->enum('fund', array('National Science Foundation', 'Harvard-Funded'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('studies');
    }
}
