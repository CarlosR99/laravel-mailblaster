<?php

namespace App\Listeners;

use App\Models\SystemLog;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;

class LogAuthenticationEvents
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        if ($event instanceof Login) {
            SystemLog::create([
                'user_id' => $event->user->id,
                'entity_type' => 'user',
                'entity_id' => $event->user->id,
                'action' => 'login',
                'description' => 'Inicio de sesión',
            ]);
        } elseif ($event instanceof Logout) {
            SystemLog::create([
                'user_id' => $event->user->id,
                'entity_type' => 'user',
                'entity_id' => $event->user->id,
                'action' => 'logout',
                'description' => 'Cierre de sesión',
            ]);
        }
    }
}
