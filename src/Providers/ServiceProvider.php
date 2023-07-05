<?php

namespace HT\LaravelSqlLogger\Providers;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

/**
 * Provider: ServiceProvider
 * @package HT\LaravelSqlLogger\Providers
 */
class ServiceProvider extends BaseServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/logging.php',
            'logging.channels'
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->register(EventServiceProvider::class);
    }
}
