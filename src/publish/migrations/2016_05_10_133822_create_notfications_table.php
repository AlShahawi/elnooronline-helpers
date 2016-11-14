<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotficationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notfications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sender_id')->nullable()->unsigned();
            $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->string('colum');

            $table->morphs('notifiable');

            $table->string('type');
            
            $table->boolean('sound')->default(true);
            $table->integer('seen');
            $table->integer('readed');
            $table->integer('check');
            $table->softDeletes();
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
        Schema::drop('notfications');
    }
}
