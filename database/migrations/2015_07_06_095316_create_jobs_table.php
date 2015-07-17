<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('title');
            $table->longText('description');
            $table->string('bidding')->default('Open'); //open|closed
            $table->string('status')->default('Uncomplete'); //complete|uncomplete
            $table->timestamps();     
        });
        
        Schema::create('job_user', function(Blueprint $table)
        {
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('job_id')->unsigned();
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->primary(array('user_id', 'job_id'));	
            $table->timestamps();
        });
        
        Schema::create('bids', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('job_id')->unsigned();
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('cascade');
            $table->longText('proposal');
            $table->string('status')->default('Pending');
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
        Schema::drop('bids');
        Schema::drop('job_user');
        Schema::drop('jobs');
    }
}
