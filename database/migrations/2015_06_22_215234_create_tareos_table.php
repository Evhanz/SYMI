<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTareosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('tareos',function(Blueprint $table)
        {
            $table->increments('id');
            $table->date('fecha');
            $table->string('observacion')->nullable();

            //relaciones
            $table->integer('area_id')->unsigned();
            $table->foreign('area_id')->references('id')->on('areas');


            $table->timestamps();

        });
	}

	/**
	 * Reverse the migrations.r
	 *
	 * @return void
	 */
	public function down()
	{
		//
        Schema::drop('tareos');
	}

}
