<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('lname',50)->nullable();
            $table->string('email')->unique();
            $table->date('date_of_ birth');
            $table->tinyInteger('gender')->nullable();
            $table->string('phone',40)->nullable();
            $table->tinyInteger('contact_mail')->nullable();
            $table->tinyInteger('contact_phone')->nullable();
            //tags
            $table->tinyInteger('place_of_birth')->nullable();
            $table->string('accent');
            $table->string('language');
             $table->string('category');
            $table->tinyInteger('hearing_disorder')->nullable();
            $table->tinyInteger('sight_disorder')->nullable();
            $table->tinyInteger('voices')->nullable();

            $table->string('password');
            $table->tinyInteger('author')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
