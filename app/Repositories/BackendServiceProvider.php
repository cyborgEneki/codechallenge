<?php

namespace App\Repositories;

use Illuminate\Support\ServiceProvider;

class BackendServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(
            'App\Contracts\BookRepositoryInterface',
            'App\Repositories\BookRepository'
        );
        $this->app->bind(
            'App\Contracts\CategoryRepositoryInterface',
            'App\Repositories\CategoryRepository'
        );
        $this->app->bind(
            'App\Contracts\DepartmentRepositoryInterface',
            'App\Repositories\DepartmentRepository'
        );
        $this->app->bind(
            'App\Contracts\UserRepositoryInterface',
            'App\Repositories\UserRepository'
        );
        $this->app->bind(
            'App\Contracts\AccesslevelRepositoryInterface',
            'App\Repositories\AccesslevelRepository'
        );
        $this->app->bind(
            'App\Contracts\BookUserRepositoryInterface',
            'App\Repositories\BookUserRepository'
        );
    }
}