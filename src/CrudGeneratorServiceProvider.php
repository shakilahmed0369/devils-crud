<?php

namespace Nox\DevilsCrud;

use Illuminate\Support\ServiceProvider;

class CrudGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/crudgenerator.php' => config_path('crudgenerator.php'),
        ]);

        $this->publishes([
            __DIR__ . '/../publish/views/' => base_path('resources/views/'),
        ]);

        $this->publishes([
            __DIR__ . '/stubs/' => base_path('resources/crud-generator/'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->commands(
            'Nox\DevilsCrud\Commands\CrudCommand',
            'Nox\DevilsCrud\Commands\CrudControllerCommand',
            'Nox\DevilsCrud\Commands\CrudModelCommand',
            'Nox\DevilsCrud\Commands\CrudMigrationCommand',
            'Nox\DevilsCrud\Commands\CrudViewCommand',
            'Nox\DevilsCrud\Commands\CrudLangCommand',
            'Nox\DevilsCrud\Commands\CrudApiCommand',
            'Nox\DevilsCrud\Commands\CrudApiControllerCommand',
            'Nox\DevilsCrud\Commands\CrudDataTableCommand'

        );
    }
}
