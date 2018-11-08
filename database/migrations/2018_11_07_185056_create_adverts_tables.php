<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertsTables extends Migration
{
    public function up()
    {
        Schema::create('advert_adverts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->references('id')->on('users')->onDelete('CASCADE');
            $table->integer('region_id')->nullable()->references('id')->on('regions');
            $table->string('title');
            $table->integer('price');
            $table->text('address');
            $table->text('content');
            $table->string('status', 16);
            $table->text('reject_reason')->nullable();
            $table->timestamps();
            $table->timestamp('published_at')->nullable();
            $table->timestamp('expires_at')->nullable();
        });

        Schema::create('advert_advert_values', function (Blueprint $table) {
            $table->integer('advert_id')->references('id')->on('advert_adverts')->onDelete('CASCADE');
            $table->string('value');
            $table->primary('advert_id');
        });

        Schema::create('advert_advert_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('advert_id')->references('id')->on('advert_adverts')->onDelete('CASCADE');
            $table->string('file');
        });
    }

    public function down()
    {
        Schema::dropIfExists('advert_advert_photos');
        Schema::dropIfExists('advert_advert_values');
        Schema::dropIfExists('advert_adverts');
    }
}
