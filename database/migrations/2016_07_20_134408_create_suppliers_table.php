<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {Schema::create('suppliers', function (Blueprint $table) {
        $table->increments('id');
        $table->timestamps();
        $table->String('name');
        $table->String('tele_no');
        $table->boolean('in');
        $table->rememberToken();
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('suppliers');
    }
}
