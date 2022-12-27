<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNavigationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nav_name');
            $table->string('alias');
            $table->string('caption')->nullable();
            $table->string('caption_nepali')->nullable();
            $table->string('nav_category');
            $table->string('page_type');
            $table->string('page_template')->nullable();
            $table->integer('position');
            $table->text('short_content')->nullable();
            $table->text('short_content_nepali')->nullable();
            $table->text('long_content')->nullable();
            $table->text('long_content_nepali')->nullable();
            $table->integer('parent_page_id');
            $table->string('icon_image')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('icon_image_caption')->nullable();
            $table->string('banner_image')->nullable();
            $table->string('link')->nullable();
            $table->string('main_attachment')->nullable();
            $table->string('attachment')->nullable();
            $table->string('page_title')->nullable();
            $table->string('page_keyword')->nullable();
            $table->string('page_description')->nullable();
            $table->enum('page_status',['1','0']);
            $table->enum('nav_status',['1','0']);
            $table->string('extra_one')->nullable();
            $table->string('extra_two')->nullable();
            $table->string('extra_three')->nullable();
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
        Schema::dropIfExists('navigations');
    }
}
