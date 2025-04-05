<?php

namespace Hascha\Routing;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Hascha\Routing\Service\Contracts\Pageable;
use Hascha\Routing\Console\RouteDataServiceInstall;

class HaschaRouteServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/routing.php', 'routing'
        );

        $this->app->bind(Pageable::class, function (Application $app) {
            return $this->pageable_data($app);
        });

        if($this->app->runningInConsole()){
            $this->commands([
                RouteDataServiceInstall::class,
            ]);
        }

        $this->map_web_routes();
    }
    
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/routing.php' => config_path('routing.php'),
        ], 'routing-config');

        Request::macro('pageable', function () {
            return app(Pageable::class);
        });

        Request::macro('routeAs', function() {
            $use = '\App\Routing\Router';
            if(class_exists($use)){
                $router = $use;
            }
            else{
                $router = config('routing.enumeration_route');
            }

            return $router::on(Route::currentRouteName());
        });
    }

    private function map_web_routes(): void
    {
        Route::middleware('web')
            ->group(__DIR__.'/../routes/web.php');
    }

    private function pageable_data(Application $app): object
    {
        $customClass = "\\App\\Routing\\PageableData";
        if(class_exists($customClass)) {
            return new $customClass();
        }

        $class = $app->config['routing']['pageable_data'];
        if(empty($class)) {
            $instance = \Hascha\Routing\PageableData::class;
            return new $instance();
        }

        return new $class();
    }
}
