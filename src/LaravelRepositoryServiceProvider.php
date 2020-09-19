<?php

namespace Lloricode\LaravelRepository;

use Illuminate\Support\ServiceProvider;
use Lloricode\LaravelRepository\Commands\LaravelRepositoryCommand;

class LaravelRepositoryServiceProvider extends ServiceProvider
{
    public static function migrationFileExists(string $migrationFileName): bool
    {
        $len = strlen($migrationFileName);
        foreach (glob(database_path("migrations/*.php")) as $filename) {
            if ((substr($filename, -$len) === $migrationFileName)) {
                return true;
            }
        }

        return false;
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes(
                [
                    __DIR__.'/../config/laravel-repository.php' => config_path('laravel-repository.php'),
                ],
                'config'
            );

            $this->publishes(
                [
                    __DIR__.'/../resources/views' => base_path('resources/views/vendor/laravel-repository'),
                ],
                'views'
            );

            $migrationFileName = 'create_laravel_repository_table.php';
            if (!$this->migrationFileExists($migrationFileName)) {
                $this->publishes(
                    [
                        __DIR__."/../database/migrations/{$migrationFileName}.stub" => database_path(
                            'migrations/'.date('Y_m_d_His', time()).'_'.$migrationFileName
                        ),
                    ],
                    'migrations'
                );
            }

            $this->commands(
                [
                    LaravelRepositoryCommand::class,
                ]
            );
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-repository');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-repository.php', 'laravel-repository');
    }
}
