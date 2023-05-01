<?php

namespace KhidirDotID\OneSignal\Providers;

use Illuminate\Support\ServiceProvider;
use KhidirDotID\OneSignal\OneSignalManager;
use KhidirDotID\OneSignal\commands\PublishUserDevice;

class OneSignalServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('onesignal', function ($app) {
            return new OneSignalManager;
        });

        $this->app->singleton('onesignal.userDevice:publish', function ($app) {
            return new PublishUserDevice;
        });

        $this->commands([
            'onesignal.userDevice:publish',
        ]);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $configPath = __DIR__ . '/../../config/onesignal.php';

        $this->publishes([
            $configPath => config_path('onesignal.php'),
        ]);
    }
}
