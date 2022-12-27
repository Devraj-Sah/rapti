<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGlobalSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('global_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('site_name');
            $table->string('site_nepali_name')->nullable();
            $table->string('site_email')->nullable();
            $table->string('phone')->nullable();
            $table->string('website_full_address')->nullable();
            $table->string('page_title')->nullable();
            $table->string('page_keyword')->nullable();
            $table->text('page_description')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('twitter_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('instagram_link')->nullable();
            $table->string('favicon')->nullable();
            $table->string('site_logo');
            $table->string('site_logo_nepali')->nullable();
            $table->enum('site_status',['1','0']);
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
        Schema::dropIfExists('global_settings');
    }
}
