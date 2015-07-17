<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessengerTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject');
            $table->timestamps();
          });
        
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('thread_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->text('body');
            $table->timestamps();

            $table->foreign('thread_id')->references('id')->on('threads');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
          });
        
        Schema::create('participants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('thread_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->timestamp('last_read');
            $table->timestamps();

            $table->foreign('thread_id')->references('id')->on('threads');
            $table->foreign('user_id')->references('id')->on('users');
          });
        
        Schema::table('participants', function (Blueprint $table) {
            $table->softDeletes();
        });
        
        DB::statement('ALTER TABLE `'.DB::getTablePrefix().'participants` CHANGE COLUMN `last_read` `last_read` timestamp NULL ON UPDATE CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP;');
        
        DB::statement('ALTER TABLE `'.DB::getTablePrefix().'participants` CHANGE COLUMN `last_read` `last_read` timestamp NULL DEFAULT NULL;');
        
        Schema::table('threads', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('messages');
        Schema::table('participants', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::drop('participants');
        Schema::table('threads', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::drop('threads');

    }
}
