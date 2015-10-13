<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonedaCambioTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::create('moneda_cambio', function(Blueprint $table)
		{
			$table->increments('id');
			/*columnas*/
			$table->decimal('monto',9,2);
			$table->date('fecha');
			$table->string('observacion')->nullable();
			/*relaciones*/

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
		Schema::drop('moneda_cambio');
	}

}
