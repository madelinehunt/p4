<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantStudyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participant_study', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            # `book_id` and `tag_id` will be foreign keys, so they have to be unsigned
            #  Note how the field names here correspond to the tables they will connect...
            # `book_id` will reference the `books table` and `tag_id` will reference the `tags` table.
            $table->bigInteger('study_id')->unsigned();
            $table->bigInteger('participant_id')->unsigned();

            # Make foreign keys
            $table->foreign('study_id')->references('id')->on('studies');
            $table->foreign('participant_id')->references('id')->on('participants');

            $table->enum('political_affiliation', array(
                'Democrat',
                'Republican',
                'Third-Party',
                'Independent',
                'Decline'
            ))->nullable();
            $table->date('date_run')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('participant_study');
    }
}
