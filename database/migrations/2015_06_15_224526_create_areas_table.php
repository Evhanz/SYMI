<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('areas',function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('descripcion');
            $table->string('observacion')->nullable();

            //relacion
            /*
            $table->integer('encargado_id')->unsigned();
            $table->foreign('encargado_id')->references('id')->on('personas');
            */
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
        Schema::drop('areas');
	}

}
