<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreaPersonaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
        //
        Schema::create('area_persona',function(Blueprint $table)
        {
            $table->increments('id');
            $table->date('f_inicio');
            $table->date('f_fin');
            $table->boolean('estado');
            $table->enum('tipo',['encargado','empleado']);
            //relaciones

            //many to many
            $table->integer('area_id')->unsigned();
            $table->foreign('area_id')->references('id')->on('areas');
            $table->integer('persona_id')->unsigned();
            $table->foreign('persona_id')->references('id')->on('personas');



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

        Schema::drop('area_persona');
	}

}
