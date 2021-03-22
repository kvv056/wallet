<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use App\Events\UserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class MakeUserWallet
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
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
		$user = $event->user;
        $user->wallet()->create(['balance'=> 0]);
		$user->save();
    }
}
