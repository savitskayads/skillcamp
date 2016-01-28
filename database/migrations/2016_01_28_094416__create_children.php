<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildren extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('childrens', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('birthday_date');
            $table->string('document')->nullable();
            $table->string('document_number')->nullable();
            $table->text('registration')->nullable();
            $table->string('school_number')->nullable();
            $table->string('school_class')->nullable();
            $table->integer('sea')->nullable();
            $table->string('sea_item')->nullable();
            $table->string('sea_years')->nullable();
            $table->string('sport')->nullable();
            $table->text('trait')->nullable();
            $table->text('pleasure')->nullable();
            $table->text('not_pleasure')->nullable();
            $table->text('stress')->nullable();
            $table->string('things')->nullable();
            $table->text('self')->nullable();
            $table->string('control')->nullable();
            $table->string('communication')->nullable();
            $table->text('communication_discomfort')->nullable();
            $table->text('conviction')->nullable();
            $table->string('bad_baby')->nullable();
            $table->string('marketing')->nullable();
            $table->text('chronic')->nullable();
            $table->string('cold')->nullable();
            $table->string('sun')->nullable();
            $table->string('diet')->nullable();
            $table->text('allergy')->nullable();
            $table->text('not_allergy')->nullable();
            $table->text('medicine_allergy')->nullable();
            $table->text('insects_allergy')->nullable();
            $table->string('train')->nullable();
            $table->text('ills')->nullable();
            $table->text('operations')->nullable();
            $table->text('rupture')->nullable();
            $table->text('concussion')->nullable();
            $table->string('bad_bug')->nullable();
            $table->text('another_medicine')->nullable();
            $table->string('physics')->nullable();
            $table->string('swim')->nullable();
            $table->string('fear_height')->nullable();
            $table->string('fear_dark')->nullable();
            $table->string('fear_animals')->nullable();
            $table->text('physics_reaction')->nullable();
            $table->string('fatiguability')->nullable();
            $table->string('vision')->nullable();
            $table->text('health')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('clothing_size')->nullable();
            $table->string('family')->nullable();
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
