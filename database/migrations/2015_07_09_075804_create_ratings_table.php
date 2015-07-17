<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratings', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('rating');
            $table->longText('comment');
            $table->timestamps();     
        });
        
        Schema::create('rating_user', function(Blueprint $table)
        {
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('rating_id')->unsigned();
            $table->foreign('rating_id')->references('id')->on('ratings')->onDelete('cascade');
            $table->integer('rated_by')->unsigned();
            $table->foreign('rated_by')->references('id')->on('users')->onDelete('cascade');
            $table->primary('rating_id');	
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
        Schema::drop('rating_user');
        Schema::drop('ratings');
    }
}
