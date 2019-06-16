<?php

namespace App\Infrastructure\Notifications;


interface SendSMS
{

    /**
     * @param $user
     * @param $order
     * @return mixed
     */
    public function send($user, $order);
}
