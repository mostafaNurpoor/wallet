<?php

namespace Modules\Wallet\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

use Modules\Wallet\Repositories\walletRepository;
use Modules\Wallet\Repositories\walletRepositoryImpl;

use Modules\Wallet\Repositories\UserRepository;
use Modules\Wallet\Repositories\UserRepositoryImpl;

class WalletServiceProvider extends ServiceProvider
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
        $this->loadMigrationsFrom(module_path('Wallet', 'Database/Migrations'));
        $this->app->bind(
            WalletRepository::class,
            WalletRepositoryImpl::class
        );
        $this->app->bind(
            UserRepository::class,
            UserRepositoryImpl::class
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            module_path('Wallet', 'Config/config.php') => config_path('wallet.php'),
        ], 'config');
        $this->mergeConfigFrom(
            module_path('Wallet', 'Config/config.php'), 'wallet'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/wallet');

        $sourcePath = module_path('Wallet', 'Resources/views');

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/wallet';
        }, \Config::get('view.paths')), [$sourcePath]), 'wallet');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/wallet');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'wallet');
        } else {
            $this->loadTranslationsFrom(module_path('Wallet', 'Resources/lang'), 'wallet');
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
            app(Factory::class)->load(module_path('Wallet', 'Database/factories'));
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
