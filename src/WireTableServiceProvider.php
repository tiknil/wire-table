<?php

namespace WireTable;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use WireTable\Console\MakeWireTableCommand;

class WireTableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'wire-table');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'wire-table');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        Blade::componentNamespace('WireTable\\Views\\Components', 'wiretable');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('wire-table.php'),
            ], 'wiretable:config');

            // Publishing the views.
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/wire-table'),
            ], ['wiretable:views']);

            // Publishing assets.
            $this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/wire-table'),
            ], 'wiretable:assets');

            // Publishing the translation files.
            $this->publishes([
                __DIR__.'/../lang' => lang_path('vendor/wire-table'),
            ], 'wiretable:lang');

            // Registering package commands.
            $this->commands([
                MakeWireTableCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'wire-table');
    }
}
