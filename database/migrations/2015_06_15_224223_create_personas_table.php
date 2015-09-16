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
            $table->string('celular');
            $table->string('fotocheck');
            $table->boolean('estado');
            $table->decimal('costo_h',9,2)->nullable()->default(NULL);

            //relaciones

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
