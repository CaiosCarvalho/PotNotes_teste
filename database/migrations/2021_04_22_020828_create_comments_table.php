<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('user_id'); 
            $table->string('title');
            $table->text('body');
            $table->timestamps();

            $table->foreign('post_id')
                        ->references('id')
                        ->on('posts');
            $table->foreign('user_id')
                        ->references('id')
                        ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
