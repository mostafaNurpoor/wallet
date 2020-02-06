<?php

namespace Modules\PayMent\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

use Modules\PayMent\Repositories\Transaction\TransactionRepository ;
use Modules\PayMent\Repositories\Transaction\TransactionRepositoryImpl ;
use Shetabit\Payment\PaymentManager;

class PayMentServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->loadMigrationsFrom(module_path('PayMent', 'Database/Migrations'));
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);

        $this->app->bind(
            TransactionRepository::class,
            TransactionRepositoryImpl::class
        );

    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('PayMent', 'Config/config.php') => config_path('payment.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('PayMent', 'Config/config.php'), 'payment'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/payment');

        $sourcePath = module_path('PayMent', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/payment';
        }, \Config::get('view.paths')), [$sourcePath]), 'payment');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/payment');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'payment');
        } else {
            $this->loadTranslationsFrom(module_path('PayMent', 'Resources/lang'), 'payment');
        }
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path('PayMent', 'Database/factories'));
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
