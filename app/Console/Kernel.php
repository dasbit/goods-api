<?php

namespace App\Console;

use App\Console\Commands\ControllerMakeCommand;
use App\Console\Commands\MiddlewareMakeCommand;
use App\Console\Commands\ModelMakeCommand;
use App\Console\Commands\PolicyMakeCommand;
use App\Console\Commands\ProviderMakeCommand;
use App\Console\Commands\RequestMakeCommand;
use App\Console\Commands\ResourceMakeCommand;
use App\Console\Commands\TestMakeCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\VendorPublishCommand;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        ModelMakeCommand::class,
        ProviderMakeCommand::class,
        ControllerMakeCommand::class,
        MiddlewareMakeCommand::class,
        RequestMakeCommand::class,
        PolicyMakeCommand::class,
        ResourceMakeCommand::class,
        TestMakeCommand::class,
        VendorPublishCommand::class
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
