<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\DepositService;
use App\Domain\WalletService;
use App\Repo\TransactionRepo;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
		$this->app->singleton(TransactionRepo::class, function ($app){
			return new TransactionRepo();
		});
        $this->app->singleton(DepositService::class, function ($app) {
            return new DepositService($app->make(TransactionRepo::class));
        });
		$this->app->singleton(WalletService::class, function ($app) {
            return new WalletService($app->make(TransactionRepo::class));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
