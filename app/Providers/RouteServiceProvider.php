<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    const WEB_NAMESPACE = 'App\Http\Controllers';
    const API_NAMESPACE = 'App\Http\ApiControllers';
    const ADMIN_NAMESPACE = 'App\Http\AdminControllers';
    const OPEN_API_NAMESPACE = 'App\Http\OpenApiControllers';
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->namespace(self::API_NAMESPACE)
                ->group(base_path('routes/api.php'));

            Route::middleware('admin')
                ->prefix('admin')
                ->namespace(self::ADMIN_NAMESPACE)
                ->group(base_path('routes/admin.php'));

            Route::middleware('web')
                ->namespace(self::WEB_NAMESPACE)
                ->group(base_path('routes/web.php'));

            Route::middleware('openApi')
                ->namespace(self::OPEN_API_NAMESPACE)
                ->group(base_path('routes/openApi.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
