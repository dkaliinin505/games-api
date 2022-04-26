<?php

namespace Modules\Authentication\Providers;

use Illuminate\Support\ServiceProvider;

class AuthenticationServiceProvider extends ServiceProvider {
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Authentication';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'authentication';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot() {
        $this->registerConfig();
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig() {
        $this->publishes([
            module_path($this->moduleName, 'Config/config.php') => config_path($this->moduleNameLower . '.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return [];
    }
}
