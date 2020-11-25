<?php

namespace App\Listeners;

use App\Providers\LoginLogoutActivityEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogoutActivities
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
     * @param  LoginLogoutActivityEvent  $event
     * @return void
     */
    public function handle(LoginLogoutActivityEvent $event)
    {
        //
    }
}
