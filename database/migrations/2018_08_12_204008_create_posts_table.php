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
          $table->increments('id');                   // we can use bigIncrement instead
          $table->integer('user_id')->unsigned();     // I added unsigned to only allow non-negative value
          $table->string('name',200);                 // I assumed 200, how long do you want it? I think 'title is more appropriate than 'name'
          $table->text('description');                // we can use longText instead
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
