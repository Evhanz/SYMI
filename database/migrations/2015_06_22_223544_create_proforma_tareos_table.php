<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProformaTareosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//

        Schema::create('proforma_tareos',function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('avance_ref');
            //relaciones

            $table->integer('tareo_id')->unsigned();
            $table->foreign('tareo_id')->references('id')->on('tareos');
            $table->integer('proforma_id')->unsigned();
            $table->foreign('proforma_id')->references('id')->on('proformas');

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
        Schema::drop('proforma_tareos');
	}

}
