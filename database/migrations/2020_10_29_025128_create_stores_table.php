<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->string('store')->unique();
            $table->string('logo');
            $table->string('slogan');
            $table->string('background_one');
            $table->string('background_two');
            $table->string('background_three');
            $table->string('background_products');
            $table->string('background_categories');
            $table->string('color_title_principal');
            $table->string('color_title_secondary');
            $table->string('color_product_price');
            $table->string('color_product_categorie');
            $table->string('color_product_discount');
            $table->string('color_product_stock');
            $table->string('background_product_price');
            $table->string('background_product_categorie');
            $table->string('background_product_discount');
            $table->string('background_product_stock');
            $table->string('color_product_alert');
            $table->string('color_product_info');
            $table->string('color_product_description');
            $table->string('radio_options');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('stores');
    }
}
