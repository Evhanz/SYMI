<?php namespace symi\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symi\Repositories\ContratoRep;

class alertContract extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'alert:contract';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'El comando sirve para enviar correos de alerta de contratos que estan vencidos.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */

	public function handle()
	{
		$contratoRep = new ContratoRep();


		/*primero actualizamos los estados de los contratos a caducados*/
	  	$contratoRep->updateContratosCaducados();

		/*luego obtenemos todos los contratos que estan por vencer*/

		$contratos = $contratoRep->getContratosPorVencer();

		/*luego enviamos el mail */

		$array = ['contratos'=>$contratos];

		try{
			$sent = Mail::send('emails/mailContratosVencidos', $array, function($message)
			{
				//remitente
				$message->from('eidel.sistemas@symisrl.pe','Servidor');

				//asunto
				$message->subject('Contratos por vencer!!!');

				//receptor
				$message->to('eidelhs@gmail.com','Yuri Alex');

			});


			if( ! $sent) dd("something wrong");
			dd($sent);

		}catch(\Exception $e){
			echo $e;

		}



	}

}
