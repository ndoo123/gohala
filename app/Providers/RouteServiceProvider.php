<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapManageRoutes();
        $this->mapAccountRoutes();
        $this->mapPosRoutes();
        $this->mapWebRoutes();
        $this->mapShopRoutes();
        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }
     protected function mapShopRoutes()
    {
        Route::prefix('{shop_url}')
             ->middleware(['web','shop'])
             ->namespace("App\Http\Controllers\Shop")
             ->group(base_path('routes/shop.php'));
    }
    protected function mapManageRoutes()
    {
        Route::domain('manage.'.env('APP_DOMAIN'))
             ->middleware(['web','auth'])
             ->namespace("App\Http\Controllers\Manage")
             ->group(base_path('routes/manage.php'));
    }
    protected function mapAccountRoutes()
    {
        Route::domain('account.'.env('APP_DOMAIN'))
             ->middleware('web')
             ->namespace("App\Http\Controllers\Account")
             ->group(base_path('routes/account.php'));
    }
    protected function mapPosRoutes()
    {
        Route::domain('pos.'.env('APP_DOMAIN'))
             ->middleware(['web','auth'])
             ->namespace("App\Http\Controllers\Pos")
             ->group(base_path('routes/pos.php'));
    }
}
