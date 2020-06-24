<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateYourwooTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yourwoo', function (Blueprint $table) {
            $table->integer('filesId')->autoIncrement();
            $table->string('filesSort');
            $table->string('filesFileName');
            $table->integer('filesAccountId');
            $table->timestamp('filesDateAdded', 0);
            $table->string('filesString');
            $table->integer('filesActive');
            $table->integer('filesAddedBy');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('yourwoo');
    }
}
