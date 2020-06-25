<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuoteCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('quote_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('subject');
            $table->timestamps();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('quote_id')->unsigned();
            $table->foreign('quote_id')->references('id')->on('quotes');
        });
    }

    public function down()
    {
        Schema::dropIfExists('quotes_comments');
    }
}
