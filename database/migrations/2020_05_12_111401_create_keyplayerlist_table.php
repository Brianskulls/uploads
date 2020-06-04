<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeyplayerlistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keyplayerlist', function (Blueprint $table) {
            $table->integer('filesId')->autoIncrement();
            $table->string('filesSort');
            $table->string('filesFileName');
            $table->string('filesAccountId');
            $table->timestamp('added_on', 0);
            $table->string('filesString')->nullable();
            $table->integer('filesActive');
            $table->integer('filesAddedBy')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keyplayerlist');
    }
}
