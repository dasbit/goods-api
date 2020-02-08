<?php

namespace App\Providers;

use App\Repositories\BaseRepository;
use App\Repositories\CategoriesRepository;
use App\Repositories\CategoriesRepositoryInterface;
use App\Repositories\EloquentRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(CategoriesRepositoryInterface::class, CategoriesRepository::class);
    }
}