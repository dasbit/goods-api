<?php

namespace App\Providers;

use App\Repositories\{
    BaseRepository,
    UsersRepository,
    CategoriesRepository,
    GoodsRepository
};

use App\Repositories\Contracts\{
    EloquentRepositoryInterface,
    UserRepositoryInterface,
    CategoriesRepositoryInterface,
    GoodsRepositoryInterface,
};

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
        $this->app->bind(UserRepositoryInterface::class, UsersRepository::class);
        $this->app->bind(GoodsRepositoryInterface::class, GoodsRepository::class);
    }
}
