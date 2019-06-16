<?php

namespace App\Listeners;

use App\Events\NewOrderAddedEvent;
use App\Infrastructure\Notifications\SendSMS;

class SendSmsListener
{
    private $sendSms;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(SendSMS $sendSMS)
    {
        $this->sendSms = $sendSMS;
    }

    /**
     * Handle the event.
     *
     * @param  NewOrderAddedEvent $event
     * @return void
     */
    public function handle(NewOrderAddedEvent $event)
    {
        $user = $event->user;
        $order = $event->order;
        $this->sendSms->send($user, $order);
    }
}
