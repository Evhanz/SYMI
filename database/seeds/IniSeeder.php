<?php

use Illuminate\Database\Seeder;

class IniSeeder extends Seeder
{

    public function run()
    {
        \DB::table('area')->insert( array(
            'descripcion' => 'Minera Baja',
            'created_at' => date("j-m-y"),
            'updated_at' => date("j-m-y"),
        ));
        \DB::table('profesion')->insert( array(
            'descripcion' => 'DEVELOPER',
            'observacion' => 'ENCARGADO DE DESARROLLAR ',
            'created_at' => date("j-m-y"),
            'updated_at' => date("j-m-y"),
        ));

        \DB::table('personas')->insert( array(
            'nombre' => 'EIDELMAN',
            'apellidoP' => 'HERNANDEZ',
            'apellidoM' => 'SALAZAR',
            'dni' => '47085011',
            'celular' => '990212662',
            'costo_h' => 9,
            'estado' => true,
            'profesion_id' => 1,
            'created_at' => date("j-m-y"),
            'updated_at' => date("j-m-y"),
        ));

        \DB::table('personas')->insert( array(
            'nombre' => 'Alexa ',
            'apellidoP' => 'Hernandez',
            'apellidoM' => 'Tasilla',
            'dni' => '85962345',
            'celular' => '990212662',
            'costo_h' => 20,
            'estado' => true,
            'created_at' => date("j-m-y"),
            'updated_at' => date("j-m-y"),
        ));
    }
}