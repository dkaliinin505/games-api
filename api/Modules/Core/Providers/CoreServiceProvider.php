<?php

namespace Modules\Core\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Modules\Core\Contracts\Geolocation\CountriesContract;
use Modules\Core\Contracts\Http\UserAgentContract;
use Modules\Core\Contracts\Security\OtpContract;
use Modules\Core\Contracts\User\UserContract;
use Modules\Core\Entities\User;
use Modules\Core\Observers\UserObserver;
use Modules\Core\Services\Core\Security\OtpService;
use Modules\Core\Services\CountriesService;
use Modules\Core\Services\Http\UserAgentService;
use Modules\Core\Services\User\UserService;

class CoreServiceProvider extends ServiceProvider {
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'Core';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'core';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot() {
        $this->registerConfig();

        $this->loadMigrationsFrom(module_path($this->moduleName, 'Database/Migrations'));

        User::observe(UserObserver::class);
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
        $this->app->bind(UserContract::class, UserService::class);
        $this->app->bind(UserAgentContract::class, UserAgentService::class);
        $this->app->bind(CountriesContract::class, CountriesService::class);
        $this->app->bind(OtpContract::class, OtpService::class);
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
