<?php
/**
 * Created by PhpStorm.
 * User: Evhanz-PC
 * Date: 10/03/2016
 * Time: 06:33 PM
 */

namespace symi\Http\Controllers;

use Symi\Entities\User;


class UserController extends Controller
{

    public function create_user(){
        $user = new User();

        $user->name ='admin';
        $user->email = 'admin@symisrl.pe';
        $user->password = bcrypt('1234');
        $user->idrol = 1;

        $user->save();
    }



}