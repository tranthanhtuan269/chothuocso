<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('address', 255)->nullable(true);
            $table->string('logo', 255)->nullable(true);
            $table->string('banner', 255)->nullable(true);
            $table->string('phone', 15)->nullable(true);
            $table->string('lat', 15)->nullable(true);
            $table->string('lng', 15)->nullable(true);
            $table->string('youtube_link', 255)->nullable(true);
            $table->string('site_url', 255)->nullable(true);
            $table->integer('show_master')->default(0);


            $table->string('slug', 255)->nullable(true);
            $table->string('keyword', 255)->nullable(true);
            $table->string('description', 255)->nullable(true);
            
            $table->integer('user_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
