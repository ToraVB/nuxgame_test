<?php

namespace App\Providers;

use App\Repositories\Contracts\ImfeelingluckyHistoryRepository as ImfeelingluckyHistoryRepositoryContract;
use App\Repositories\Contracts\UserRepository as UserRepositoryContract;
use App\Repositories\Contracts\UserLinkRepository as UserLinkRepositoryContract;
use App\Repositories\ImfeelingluckyHistoryRepository;
use App\Repositories\UserLinkRepository;
use App\Services\ImfeelingluckyService;
use App\Services\Contracts\ImfeelingluckyService as ImfeelingluckyServiceContract;
use App\Services\Contracts\LinkService as LinkServiceContract;
use App\Services\Contracts\RegisterService as RegisterServiceContract;
use App\Repositories\UserRepository;
use App\Services\LinkService;
use App\Services\RegisterService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        /*
         * Repositories
         */
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
        $this->app->bind(UserLinkRepositoryContract::class, UserLinkRepository::class);
        $this->app->bind(ImfeelingluckyHistoryRepositoryContract::class, ImfeelingluckyHistoryRepository::class);
        /*
         * Services
         */
        $this->app->bind(LinkServiceContract::class, LinkService::class);
        $this->app->bind(RegisterServiceContract::class, RegisterService::class);
        $this->app->bind(ImfeelingluckyServiceContract::class, ImfeelingluckyService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
