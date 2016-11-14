<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('langable_id');
          $table->string('langable_type');
          $table->integer('lang')->nullable()->unsigned();
          $table->foreign('lang')->references('id')->on('langs')->onDelete('cascade');
          $table->string('colum');
          $table->text('trans');
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
        Schema::drop('languages');
    }
}
