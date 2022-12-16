<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255);
            $table->mediumText('description');
            $table->string('mime', 255);
            $table->string('original_filename', 255);
            $table->string('filename', 255);
            $table->integer('user_id');
            $table->string('slug', 255);
            $table->integer('security');
            $table->timestamps();
            $table->integer('del_flag');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
