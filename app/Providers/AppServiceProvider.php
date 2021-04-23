<?php

namespace App\Providers;

use App\Services\ParserServiceInterface;
use App\Services\ParserXmlService;
use App\Services\SocialiteService;
use Illuminate\Pagination\Paginator;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        $this->app->bind(ParserServiceInterface::class, fn() => new ParserXmlService());
        $this->app->bind(SocialiteService::class, fn() => new SocialiteService());
    }
}
