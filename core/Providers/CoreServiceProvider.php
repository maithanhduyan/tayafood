<?php

namespace Core\Providers;

use Illuminate\Support\ServiceProvider;
use Core\Repositories\BookRepository;
use Core\Repositories\BookRepositoryContract;

class CoreServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BookRepositoryContract::class, BookRepository::class);
        $this->app->bind(BookServiceContract::class, BookService::class);
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
