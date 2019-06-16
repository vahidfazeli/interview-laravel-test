<?php

namespace App\Listeners;

use App\Events\NewOrderAddedEvent;

class SendEmailListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }


    /**
     * @param NewOrderAddedEvent $event
     */
    public function handle(NewOrderAddedEvent $event)
    {
        //
    }
}
