<?php

namespace Codetechnl\NovaAwsCloudwatch;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Http\Middleware\Authenticate;
use Laravel\Nova\Nova;
use Codetechnl\NovaAwsCloudwatch\Http\Middleware\Authorize;
use Laravel\Nova\Menu\MenuSection;

/**
 *
 */
class ToolServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::script('NovaAwsCloudwatch', __DIR__.'/../dist/js/tool.js');

        $this->app->booted(function () {
            $this->routes();
        });

        $this->mergeConfigFrom(__DIR__.'../../config/nova_aws_cloudwatch.php', 'nova_aws_cloudwatch');

    }

    /**
     * Register the tool's routes.
     *
     * @return void
     */
    protected function routes()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        $this->publishes([
            __DIR__.'/../config/nova_aws_cloudwatch.php' => config_path('nova_aws_cloudwatch.php')
        ], 'nova-aws-cloudwatch-config');

        Nova::router(['nova', Authenticate::class, Authorize::class], 'nova-aws-cloudwatch')
            ->group(__DIR__ . '/../routes/inertia.php');

        Route::middleware(['nova', Authorize::class])
            ->prefix('nova-vendor/nova-aws-cloudwatch')
            ->group(__DIR__ . '/../routes/api.php');
    }

    /**
     * @return MenuSection
     */
    public function menu()
    {
        return MenuSection::make('Price Tracker')
            ->path('/nova-aws-cloudwatch')
            ->icon('server');
    }
}
