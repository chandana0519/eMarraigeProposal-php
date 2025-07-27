<?php

namespace App\Listeners;

use App\Events\UserEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Carbon\Carbon;
use App\OnlineUser;

class UserEventHandler implements ShouldQueue
{
    /**
     * Handle user login events.
     */
    public function onUserLogin($event) 
    {
        $event->last_login = Carbon::now();
        $online = $event->Online;
        if (is_null($online)) {
            $online = new OnlineUser;
            if ($online === null) {
            }
            $online->status = (is_null($event->profileimage_id) ? 4 : 1);
            $event->Online()->save($online);
            $event->load('Online');
        } 
        else 
        {
            $online->status = (is_null($event->profileimage_id) ? 4 : 1);
            $online->save();
            /* not required to update the timestamp if user is inactive ( doesnt have a profile pic)
            if($online->isDirty())
            {
                $online->save();
            }
            else
            {
                $online->touch();
            }
            */
        }
        $online = $event->Online;
        $event->save();
    }

    /**
     * Handle user logout events.
     */
    public function onUserLogout($event) 
    {
        $online = $event->Online;
        if (!is_null($online)) {
            $online->status = (is_null($event->profileimage_id) ? 4 : 3);
            if($online->isDirty())
            {
                $online->save();
            }         
        }        
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen(
            'auth.login',
            'App\Listeners\UserEventHandler@onUserLogin'
        );

        $events->listen(
            'auth.logout',
            'App\Listeners\UserEventHandler@onUserLogout'
        );
    }
}
