<?php

/*
 * This file is part of Laravel Likeable.
 *
 * (c) Anton Komarev <anton@komarev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Igorsgm\Likeable\Providers;

use Igorsgm\Likeable\Console\LikeableRecountCommand;
use Igorsgm\Likeable\Contracts\Like as LikeContract;
use Igorsgm\Likeable\Contracts\LikeableService as LikeableServiceContract;
use Igorsgm\Likeable\Contracts\LikeCounter as LikeCounterContract;
use Igorsgm\Likeable\Models\Like;
use Igorsgm\Likeable\Models\LikeCounter;
use Igorsgm\Likeable\Observers\LikeObserver;
use Igorsgm\Likeable\Services\LikeableService;
use Illuminate\Support\ServiceProvider;

/**
 * Class LikeableServiceProvider.
 *
 * @package Igorsgm\Likeable\Providers
 */
class LikeableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerConsoleCommands();
        $this->registerObservers();
        $this->registerPublishes();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerContracts();
    }

    /**
     * Register Likeable's models observers.
     *
     * @return void
     */
    protected function registerObservers()
    {
        $this->app->make(LikeContract::class)->observe(LikeObserver::class);
    }

    /**
     * Register Likeable's console commands.
     *
     * @return void
     */
    protected function registerConsoleCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                LikeableRecountCommand::class,
            ]);
        }
    }

    /**
     * Register Likeable's classes in the container.
     *
     * @return void
     */
    protected function registerContracts()
    {
        $this->app->bind(LikeContract::class, Like::class);
        $this->app->bind(LikeCounterContract::class, LikeCounter::class);
        $this->app->singleton(LikeableServiceContract::class, LikeableService::class);
    }

    /**
     * Setup the resource publishing groups for Likeable.
     *
     * @return void
     */
    protected function registerPublishes()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../../database/migrations' => database_path('migrations'),
            ], 'migrations');
        }
    }
}
