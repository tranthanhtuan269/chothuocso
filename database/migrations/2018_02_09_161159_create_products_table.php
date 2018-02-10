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
            $table->increments('id');
            $table->string('name', 255);
            $table->string('price', 255)->nullable(true);
            $table->string('image', 255)->nullable(true);
            $table->string('images', 255)->nullable(true);
            $table->string('infomation', 5000)->nullable(true);
            $table->integer('category_id')->unsigned();
            $table->integer('company_id')->unsigned();

            $table->string('slug', 255)->nullable(true);
            $table->string('keyword', 255)->nullable(true);
            $table->string('description', 255)->nullable(true);

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('company_id')->references('id')->on('companies');
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
