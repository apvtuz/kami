<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('user_id');
            $table->text('title')->nullable();
            $table->text('content')->nullable();
            //tags
            $table->tinyInteger('place_of_birth')->nullable();
            $table->tinyInteger('accent')->nullable();
            $table->tinyInteger('language')->nullable();
            $table->tinyInteger('hearing_disorder')->nullable();
            $table->tinyInteger('sight_disorder')->nullable();
            $table->tinyInteger('voices')->nullable();
            $table->tinyInteger('category')->nullable();
            // experiment info
            $table->text('exp_info')->nullable();
            $table->dateTime('conducted_from')->nullable();
            $table->dateTime('conducted_to')->nullable();
            $table->string('takes')->nullable();
            $table->string('timeslots')->nullable();
            //Participant recruitment infromation
            $table->Integer('numer_of_participants')->nullable();
            $table->tinyInteger('age_from')->nullable();
            $table->tinyInteger('age_to')->nullable();
            $table->tinyInteger('status')->default(0);
            //status:0 - unpublished, 1-published, 2-finished, 3-deferred



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
        Schema::dropIfExists('posts');
    }
}
