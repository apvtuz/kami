<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->increments('id');
            $table->Integer('post_id');//id of the post
             $table->Integer('post_user_id');//id of the post author
            $table->Integer('user_id');// user, recorded for post
            $table->TinyInteger('action');
            //action: 1 - to participate, 2 to be in waiting list
            $table->tinyInteger('status')->default(0);
            //status: 0 - waiting, 1 - approved, 2 - declined, 3 - banned
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
        Schema::dropIfExists('records');
    }
}
