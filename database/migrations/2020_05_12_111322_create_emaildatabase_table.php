<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmaildatabaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emaildatabase', function (Blueprint $table) {
            $table->integer('filesId')->autoIncrement();
            $table->string('filesFileName');
            $table->string('filesSort');
            $table->integer('filesAccountId');
            $table->timestamp('filesDateAdded', 0);
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
        Schema::dropIfExists('emaildatabase');
    }
}
