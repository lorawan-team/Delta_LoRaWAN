<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;
use ReflectionClass;

abstract class AbstractServiceProvider extends IlluminateServiceProvider
{
    /**
     * Setup the package config.
     *
     * @param  string       $name
     * @param  string|null  $source
     * @return void
     */
    protected function setupConfig($name, $source = null)
    {
        $path = $source ?: realpath($this->getDir()."/../../config/{$name}.php");

        $this->publishes([$path => config_path("{$name}.php")]);

        $this->mergeConfigFrom($path, $name);
    }

    /**
     * Setup the package migrations.
     *
     * @param  string|null  $source
     * @return void
     */
    protected function setupMigrations($source = null)
    {
        $path = $source ?: realpath($this->getDir().'/../../database/migrations/');

        $this->publishes([$path => database_path('migrations')], 'migrations');
    }

    /**
     * Setup the connection.
     *
     * @param  string       $name
     * @param  string|null  $source
     * @return void
     */
    protected function setupConnection($name, $source = null)
    {
        $connection = $source ?: "{$name}.connection";

        $config = $this->app['config'];

        $config->set(
            "database.connections.{$name}",
            $config[$connection]
        );
    }

    /**
     * Register class aliases.
     *
     * @return void
     */
    protected function registerClassAliases(array $aliases)
    {
        foreach ($aliases as $key => $aliases) {
            foreach ((array) $aliases as $alias) {
                $this->app->alias($key, $alias);
            }
        }
    }

    /**
     * Get directory from calling class.
     *
     * @return string
     */
    private function getDir()
    {
        $reflector = new ReflectionClass(get_class($this));
        $filename = $reflector->getFileName();

        return dirname($filename);
    }
}