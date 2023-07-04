<?php

namespace Sashagm\Notification\Providers;

use Illuminate\Support\ServiceProvider;
use Sashagm\Notification\Traits\BootTrait;
use Sashagm\Notification\Console\Commands\CreateCommand;
use Sashagm\Notification\Console\Commands\InstallCommand;
use Sashagm\Notification\Console\Commands\TestNotificationCommand;

class NotificationServiceProvider extends ServiceProvider
{
    use BootTrait;
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

        $this->loadRoutesFrom(__DIR__ . '/../routes/notification.php');

        // $this->mergeConfigFrom(
        //    __DIR__.'/../config/nf.php', 'nf'
        //);

        $this->bootSys();

        $this->publishes([
            __DIR__ . '/../config/nf.php' => config_path('nf.php'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                CreateCommand::class,
                TestNotificationCommand::class,
                InstallCommand::class,

            ]);
        }
    }
}
