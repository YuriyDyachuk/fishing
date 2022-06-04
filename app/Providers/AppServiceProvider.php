<?php

namespace App\Providers;

use App\Contract\UserInterface;
use App\Contract\ReportInterface;
use App\Repositories\UserRepository;
use App\Repositories\ReportRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(ReportInterface::class, ReportRepository::class);

        /* ADMIN */
        $this->app->bind(\App\Contract\Admin\UserInterface::class, \App\Repositories\Admin\UserRepository::class);
        $this->app->bind(\App\Contract\Admin\ReportInterface::class, \App\Repositories\Admin\ReportRepository::class);
        $this->app->bind(\App\Contract\Admin\RegionInterface::class, \App\Repositories\Admin\RegionRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
