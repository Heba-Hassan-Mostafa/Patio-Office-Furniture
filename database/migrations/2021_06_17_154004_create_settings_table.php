<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('siteName')->nullable();
			$table->string('logo')->nullable();
			$table->string('icon')->nullable();
			$table->string('phone_one')->nullable();
            $table->string('phone_two')->nullable();
            $table->string('address')->nullable();
			$table->string('gmail')->nullable();
			$table->string('facebook')->nullable();
			$table->string('youtube')->nullable();
			$table->string('twitter')->nullable();
			$table->string('instagram')->nullable();
			$table->longtext('about_patio')->nullable();
			$table->string('keywords')->nullable();
			$table->longtext('description')->nullable();
			$table->enum('status', ['open', 'close'])->default('open');
			$table->longtext('message_maintenance')->nullable();

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
        Schema::dropIfExists('settings');
    }
}