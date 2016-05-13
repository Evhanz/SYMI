<?php namespace symi\Http\Controllers;

use Symi\Entities\User;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('welcome');
	}

    public function main(){
        return view('main/main');
    }


	public function create_user(){

		$user = new User();

		$user->dni ='12345678';
		$user->tipo = 'control';
		$user->password = bcrypt('1234');

		$user->save();
	}

}
