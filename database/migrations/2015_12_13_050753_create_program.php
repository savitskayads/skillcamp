<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgram extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function(Blueprint $table)
        {
            $table->increments('id', 11);
            $table->string('title', 255);
            $table->string('description', 255);
            $table->string('plases', 255);
            $table->integer('price');
            $table->integer('vacation');
            $table->timestamp('start_date');
            $table->timestamp('finish_date');
            $table->text('content');
            $table->boolean('published')->default(false);
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
        //
    }
}
