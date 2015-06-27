<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('personas',function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('nombres');
            $table->string('apellidoP');
            $table->string('apellidoM');
            $table->string('dni');
            $table->boolean('estado');

            //relaciones
            $table->integer('costo_hombre_id')->unsigned();
            $table->foreign('costo_hombre_id')->references('id')->on('costo_hombres');

            $table->integer('profesion_id')->unsigned();
            $table->foreign('profesion_id')->references('id')->on('profesiones');

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
        Schema::drop('personas');
	}

}
