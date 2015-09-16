<?php

use Illuminate\Database\Seeder;

class IniSeeder extends Seeder
{

    public function run()
    {
        \DB::table('areas')->insert( array(
            'descripcion' => 'Minera Baja',
            'created_at' => date("j-m-y"),
            'updated_at' => date("j-m-y"),
        ));
        \DB::table('profesiones')->insert( array(
            'descripcion' => 'DEVELOPER',
            'observacion' => 'ENCARGADO DE DESARROLLAR ',
            'created_at' => date("j-m-y"),
            'updated_at' => date("j-m-y"),
        ));

        \DB::table('personas')->insert( array(
            'nombres' => 'EIDELMAN',
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
            'nombres' => 'Alexa ',
            'apellidoP' => 'Hernandez',
            'apellidoM' => 'Tasilla',
            'dni' => '85962345',
            'celular' => '990212662',
            'costo_h' => 20,
            'estado' => true,
            'profesion_id' => 1,
            'created_at' => date("j-m-y"),
            'updated_at' => date("j-m-y"),
        ));
    }
}