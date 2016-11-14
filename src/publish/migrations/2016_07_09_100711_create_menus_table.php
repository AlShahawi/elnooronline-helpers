<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('page_id')->nullable()->unsigned();
          $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
          $table->integer('parent');
          $table->string('position');
          $table->string('icon');
          $table->integer('order');
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
        Schema::drop('menus');
    }
}
