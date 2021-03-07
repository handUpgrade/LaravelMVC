<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInrtosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title',50);
            $table->string('append');
            $table->string('place',100);
            $table->string('master',20);
            $table->string('photo',150);
            $table->unsignedInteger('weekset');
            $table->time('starttime');
            $table->time('endtime');
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
        Schema::dropIfExists('intros');
    }
}
