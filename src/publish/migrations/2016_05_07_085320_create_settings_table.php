<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('site_name');
            $table->string('site_desc');
            $table->string('copyright');
            $table->string('mail');
            $table->string('phone');
            $table->text('keywords');
            $table->enum('maintenance',['open','close']);
            $table->string('facebook');
            $table->string('twitter');
            $table->string('linkedin');
            $table->string('googleplus');
            $table->boolean('send_newsletter')->default(true);
            $table->string('except_words');
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
        Schema::drop('settings');
    }
}
