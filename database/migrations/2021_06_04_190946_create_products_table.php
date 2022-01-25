<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->increments('id');
            $table->string('product_name');
            $table->string('product_code');
            $table->integer('category_id')->unsigned();
            $table->integer('sub_category_id')->nullable()->unsigned();
            $table->string('price')->nullable();
            $table->string('discount')->nullable();
            $table->longText('detail');
            $table->integer('features')->nullable();
            $table->integer('best_sellers')->nullable();
            $table->integer('on_sale')->nullable();
            $table->integer('offers')->nullable();
            $table->string('image');
            $table->integer('order')->nullable();
            $table->unsignedTinyInteger('status')->default(1);

            $table->foreign('category_id')->references('id')->on('categories')
						->onDelete('cascade')
						->onUpdate('cascade');
             $table->foreign('sub_category_id')->references('id')->on('sub_categories')
						->onDelete('cascade')
						->onUpdate('cascade');
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
        Schema::dropIfExists('products');
    }
}