<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermessionMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permession_methods', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('permession_id')->nullable()->unsigned();
            $table->foreign('permession_id')->references('id')->on('permessions')->onDelete('cascade');
            $table->string('method');
            $table->boolean('has_rule')->default(true);
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
        Schema::drop('permession_methods');
    }
}
