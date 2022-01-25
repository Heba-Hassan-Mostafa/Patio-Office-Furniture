<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_category_id')->unsigned();
            $table->string('title');
            $table->longText('content');
            $table->string('image');
            $table->unsignedTinyInteger('status')->default(1);
            $table->string('keywords');
			$table->longtext('description');
             $table->foreign('post_category_id')->references('id')->on('post_categories')
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
        Schema::dropIfExists('posts');
    }
}
