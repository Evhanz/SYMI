<?php

use Illuminate\Database\Seeder;
/**
 * Created by PhpStorm.
 * User: Servidor Symi
 * Date: 24/06/2015
 * Time: 12:58 PM
 */

class MarcaTableSeeder extends Seeder
{

    public function run()
    {
        \DB::table('marcas')->insert( array(
            'descripcion' => 'Lenovo',
            'observacion' => 'es pro',
            'created_at' => date("j-m-y"),
            'updated_at' => date("j-m-y"),
        ));
    }
}