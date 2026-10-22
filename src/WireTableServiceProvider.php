<?php

namespace WireTable;

use App;
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
        if (!App::configurationIsCached()) {
            $packageConfig = require __DIR__.'/../config/config.php';
            $publishedConfig = $this->app['config']->get('wire-table', []);

            // Serve il mergeConfigRecursive così anche valori innestati al secondo livello usando il default della libreria se assenti nel config di progetto
            $mergedConfig = $this->mergeConfigRecursive($packageConfig, $publishedConfig);

            $this->app['config']->set('wire-table', $mergedConfig);
        }
    }

    private function mergeConfigRecursive(array $base, array $replacement): array
    {
        foreach ($replacement as $key => $value) {
            if (is_array($value) && isset($base[$key]) && is_array($base[$key])) {
                // Se è un array numerico (lista), l'utente sovrascrive completamente l'elenco
                if (array_is_list($value)) {
                    $base[$key] = $value;
                } else {
                    // Se è un array associativo (come 'pagination'), continua il merge ricorsivo
                    $base[$key] = $this->mergeConfigRecursive($base[$key], $value);
                }
            } else {
                $base[$key] = $value;
            }
        }

        return $base;
    }
}
