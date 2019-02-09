<?php

namespace App\Console;

use App\Console\Commands\CreateTables;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // Nord\Lumen\DynamoDb\Console\CreateTablesCommand::class,
        // \Nord\Lumen\DynamoDb\Console\DeleteTablesCommand::class
        CreateTables::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //
    }
}
