<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */ 
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('question_id')->unsigned();
            $table->integer('option_id')->unsigned()->nullable();
            $table->string('model_text')->nullable();
            $table->timestamps();

            $table->foreign('question_id')
            ->references('id')
            ->on('questions')
            ->onDelete('cascade');

            // $table->foreign('option_id')
            // ->references('id')
            // ->on('options')
            // ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
