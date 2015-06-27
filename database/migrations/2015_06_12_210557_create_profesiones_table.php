<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfesionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        //
        Schema::create('profesiones',function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('descripcion');
            $table->string('observacion')->nullable();


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

        Schema::drop('profesiones');

	}

}
