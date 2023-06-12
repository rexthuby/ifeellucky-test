<?php

namespace App\Providers;

use App\CacheManagers\AccessKeyCache;
use App\Generators\AccessKeyGenerator;
use App\Managers\AccessKeyManager;
use App\Repositories\AccessKeyRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(AccessKeyManager::class, function (){
            return new AccessKeyManager(new AccessKeyCache(),new AccessKeyRepository());
        });
    }
}
