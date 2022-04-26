<?php

namespace App\Providers;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->app->bind(Filesystem::class, function () {
            if ($this->app->environment("prod")) {
                return Storage::disk("s3");
            }

            return Storage::disk("public");
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        //
    }
}
