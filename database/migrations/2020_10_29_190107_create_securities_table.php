<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecuritiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('securities', function (Blueprint $table) {
            $table->id();
            $table->string("ip");
            $table->string("location")->nullable();
            $table->string("org")->nullable();
            $table->string("city")->nullable();
            $table->string("region")->nullable();
            $table->string("country")->nullable();
            $table->string("col_1")->nullable();
            $table->string("col_2")->nullable();
            $table->string("col_3")->nullable();
            $table->string("col_4")->nullable();
            $table->string("col_5")->nullable();
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
        Schema::dropIfExists('securities');
    }
}
