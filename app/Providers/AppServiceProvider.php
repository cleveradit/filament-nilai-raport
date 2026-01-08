<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Event;
use App\Listeners\SendTelegramActivityNotification;

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
        Event::listen(
            'eloquent.created: Spatie\Activitylog\Models\Activity',
            [SendTelegramActivityNotification::class, 'handle']
        );
    }
}
