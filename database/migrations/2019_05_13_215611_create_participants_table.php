<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('id_code');
            $table->enum('participant_type', array('mturk', 'fMRI'));
            $table->enum('gender', array(
                'Male',
                'Female',
                'Non-binary',
                'Decline'
            ));
            $table->enum('race', array(
                'American Indian or Alaska Native',
                'Asian',
                'Black or African-American',
                'Native Hawaiian or Other Pacific Islander',
                'White',
                'Other',
                'Multi-ethnic',
                'Decline',
            ));
            $table->enum('ethnicity', array(
                'Hispanic',
                'Not Hispanic',
                'Decline',
            ));
            $table->bigInteger('age');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participants');
    }
}
