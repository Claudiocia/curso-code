<?php

namespace pizzaexpress\Providers;

use Illuminate\Support\ServiceProvider;
use Faker\Generator as FakerGenerator;
use Faker\Factory as FakerFactory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(FakerGenerator::class, function () {
            return FakerFactory::create('pt_BR');
        });

        $this->app->bind('Dmitrovskiy\IonicPush\PushProcessor', function(){
            return new \Dmitrovskiy\IonicPush\PushProcessor(
                env('IONIC_APP_ID'), env('IONIC_SECRET_ID'));
        });
    }
}
