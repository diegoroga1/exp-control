<?php

namespace App\Listeners;

use App\Events\SetUserSessionEvent;
use App\Services\AuthService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SetUserSessionListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(SetUserSessionEvent $event)
    {
        $entity = $event->entity;
        $user = auth()->user() ?: AuthService::getAdminUser();
        $entity->user_id = $user->id;
    }
}
