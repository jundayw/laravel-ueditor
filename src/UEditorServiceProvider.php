<?php

namespace Jundayw\LaravelUEditor;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

/**
 * Class UEditorServiceProvider.
 */
class UEditorServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/ueditor.php', 'ueditor');
        $this->app->singleton('ueditor.storage', function ($app) {
            return new StorageManager(Storage::disk($app['config']->get('ueditor.disk', 'public')));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @param \Illuminate\Routing\Router $router
     */
    public function boot(Router $router)
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'ueditor');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'ueditor');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/ueditor.php' => config_path('ueditor.php'),
            ], 'ueditor-config');
            $this->publishes([
                __DIR__ . '/../assets/ueditor' => public_path(app('config')->get('ueditor.path', 'ueditor')),
            ], 'ueditor-assets');
            $this->publishes([
                __DIR__ . '/../resources/lang' => resource_path('lang'),
            ], 'ueditor-lang');
            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views'),
            ], 'ueditor-views');
        }

        $this->registerRoute($router);
    }

    /**
     * Register routes.
     *
     * @param $router
     */
    protected function registerRoute($router)
    {
        if (!$this->app->routesAreCached()) {
            $router->group(config('ueditor.route', []), function ($router) {
                $router->any(config('ueditor.url'), config('ueditor.controller'));
            });
        }
    }
}
