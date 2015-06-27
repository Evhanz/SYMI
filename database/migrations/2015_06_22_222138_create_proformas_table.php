<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProformasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        Schema::create('proformas',function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('numero');
            $table->decimal('monto_MO');

            $table->date('f_inicio')->nullable();
            $table->date('f_fin')->nullable();
            $table->tinyInteger('n_dias');

            //relaciones
            $table->integer('area_id')->unsigned();
            $table->foreign('area_id')->references('id')->on('areas');
            $table->integer('estado_id')->unsigned();
            $table->foreign('estado_id')->references('id')->on('estado_proformas');


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
        Schema::drop('proformas');
	}

}
