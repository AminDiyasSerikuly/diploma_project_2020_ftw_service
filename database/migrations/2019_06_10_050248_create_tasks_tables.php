<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('task');
            $table->bigInteger('cat_id');
            $table->text('narrative');
            $table->boolean('ip')->default('0');
            $table->float('amount')->default('0');
            $table->boolean('email_check')->defautl('0');
            $table->boolean('allow_all')->defautl('0');
            $table->datetime('cdate');
            $table->bigInteger('user_id');
            $table->boolean('status')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
