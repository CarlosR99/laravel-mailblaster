<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use App\Listeners\LogAuthenticationEvents;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Login::class => [
            LogAuthenticationEvents::class,
        ],
        Logout::class => [
            LogAuthenticationEvents::class,
        ],
    ];

    public function boot(): void
    {
        //
    }
}