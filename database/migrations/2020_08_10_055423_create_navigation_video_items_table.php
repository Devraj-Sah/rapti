<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavigationVideoItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigation_video_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('sort');
            $table->integer('nav_id')->unsigned()->nullable();
            $table->string('name')->nullable();
            $table->string('name_nepali')->nullable();
            $table->string('vlink');
            $table->string('content')->nullable();
            $table->string('content_nepali')->nullable();
            $table->string('extra_one')->nullable();
            $table->string('extra_two')->nullable();
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
        Schema::dropIfExists('navigation_video_items');
    }
}
