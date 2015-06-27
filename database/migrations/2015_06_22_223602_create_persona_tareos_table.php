<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonaTareosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('persona_tareos',function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('h_trabajadas');
            //relaciones


            //many to many
            $table->integer('tareo_id')->unsigned();
            $table->foreign('tareo_id')->references('id')->on('tareos');
            $table->integer('persona_id')->unsigned();
            $table->foreign('persona_id')->references('id')->on('personas');
            //to belongs
            $table->integer('proforma_id')->unsigned();
            $table->foreign('proforma_id')->references('id')->on('proformas');
            $table->integer('costoHombre_id')->unsigned();
            $table->foreign('costoHombre_id')->references('id')->on('costo_hombres');




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
        Schema::drop('persona_tareos');
	}

}
