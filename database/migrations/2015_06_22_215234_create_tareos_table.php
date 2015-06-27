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
            $table->integer('supervisor_id')->unsigned();
            $table->foreign('supervisor_id')->references('id')->on('personas');


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
		//
        Schema::drop('tareos');
	}

}
