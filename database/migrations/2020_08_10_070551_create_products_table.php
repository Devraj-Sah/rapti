<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category_id');
            $table->string('name');
            $table->string('slug');
            $table->longText('description')->nullable();
            $table->longText('short_desc')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('price')->nullable();
            $table->string('compare_price')->nullable();
            $table->integer('quantity')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->integer('order')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->integer('featured_products')->default(0);
            $table->string('item')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
