<?php namespace symi\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel {

	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		'symi\Console\Commands\Inspire',
		'symi\Console\Commands\logDemon',
		'symi\Console\Commands\alertContract',
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
		$schedule->command('inspire')
				 ->hourly();
		//$schedule->command('log:demo')->everyFiveMinutes();
		$schedule->command('alert:contract')->dailyAt('09:00');

	}

}
