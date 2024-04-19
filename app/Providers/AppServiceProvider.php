<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\ServiceProvider;
use NotificationChannels\Fcm\FcmChannel;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->resolving(LengthAwarePaginator::class, function ($paginator) {
            return $paginator->withQueryString();
        });

        $this->polymorphAliases();
        $this->registerCustomChannel();
    }

    protected function polymorphAliases(): void
    {
        Relation::morphMap([
            'user' => \App\Modules\Membership\Models\User::class,
        ]);
    }

    protected function registerCustomChannel(): void
    {
        Notification::extend('firebase', function ($app) {
            return FcmChannel::class;
        });
    }
}
