<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Repository\ChauffeurRepository;
use App\Repositories\Repository\DetenteurRepository;
use App\Repositories\Interfaces\ChauffeurRepositoryInterface;
use App\Repositories\Interfaces\DetenteurRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DetenteurRepositoryInterface::class, DetenteurRepository::class);
        $this->app->bind(ChauffeurRepositoryInterface::class, ChauffeurRepository::class);
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
