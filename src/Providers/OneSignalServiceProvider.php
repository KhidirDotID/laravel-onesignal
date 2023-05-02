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
        $this->mergeConfigFrom($this->getConfigPath(), 'onesignal');

        $this->app->singleton('onesignal', function ($app) {
            return new OneSignalManager($app);
        });

        $this->app->singleton('onesignal.userDevice:publish', function ($app) {
            return new PublishUserDevice($app);
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
        $this->publishes([
            $this->getConfigPath() => config_path('onesignal.php'),
        ], 'onesignal-config');
    }

    public function getConfigPath()
    {
        return __DIR__ . '/../../config/onesignal.php';
    }
}
