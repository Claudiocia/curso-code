<?php

namespace pizzaexpress\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->bind(
           'pizzaexpress\Repositories\CategoryRepository',
           'pizzaexpress\Repositories\CategoryRepositoryEloquent'
       );
        $this->app->bind(
            'pizzaexpress\Repositories\ClientRepository',
            'pizzaexpress\Repositories\ClientRepositoryEloquent'
        );
        $this->app->bind(
            'pizzaexpress\Repositories\OrderItemRepository',
            'pizzaexpress\Repositories\OrderItemRepositoryEloquent'
        );
        $this->app->bind(
            'pizzaexpress\Repositories\OrderRepository',
            'pizzaexpress\Repositories\OrderRepositoryEloquent'
        );
        $this->app->bind(
            'pizzaexpress\Repositories\ProductRepository',
            'pizzaexpress\Repositories\ProductRepositoryEloquent'
        );
        $this->app->bind(
            'pizzaexpress\Repositories\UserRepository',
            'pizzaexpress\Repositories\UserRepositoryEloquent'
        );
        $this->app->bind(
            'pizzaexpress\Repositories\CupomRepository',
            'pizzaexpress\Repositories\CupomRepositoryEloquent'
        );
    }
}
