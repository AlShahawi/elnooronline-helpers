<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filables', function (Blueprint $table) {
            $table->increments('id');

             $table->integer('file_id')->nullable()->unsigned();
             $table->foreign('file_id')->references('id')->on('files')->onDelete('cascade');

             $table->integer('filable_id');
             $table->string('filable_type');
             $table->string('input');
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
        Schema::drop('filables');
    }
}
