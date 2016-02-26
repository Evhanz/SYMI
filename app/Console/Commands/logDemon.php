<?php namespace symi\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class logDemon extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'log:demo';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description.';

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
		//
		\Log::info('I was here @Evhanz '.\Carbon\Carbon::now());
	}



}
