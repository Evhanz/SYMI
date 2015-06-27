<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadoProformasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('estado_proformas',function(Blueprint $table)
        {
            $table->increments('id');
            $table->enum('tipo',['creada','proceso','finalizada']);
            $table->date('fecha');

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
        Schema::drop('estado_proformas');
	}

}
