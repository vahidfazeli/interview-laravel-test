<?php


namespace App\Infrastructure\Notifications\Providers;

use App\Infrastructure\Notifications\SendSMS;

class FirstProvider implements SendSMS
{
    /**
     * @var string
     */
    private $url;
    /**
     * @var string
     */
    private $fields;


    /**
     * FirstProvider constructor.
     */
    public function __construct()
    {
        $this->url = 'https://demo3224310.mockable.io/first_provider';
        $this->fields = 'userkey=' . config('app.first_provider.userkey') . '&passkey=' . config('app.first_provider.passkey');
    }

    /**
     * @param $user
     * @param $order
     * @return mixed|void
     * @throws \Exception
     */
    public function send($user, $order)
    {
        $message = ''; // read from config
        $this->fields .= '&nohp=' . $user->phone_number . '&pesan=' . urlencode($message);

        try {
            $curlHandle = curl_init();
            curl_setopt($curlHandle, CURLOPT_URL, $this->url);
            curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $this->fields);
            curl_setopt($curlHandle, CURLOPT_HEADER, 0);
            curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curlHandle, CURLOPT_TIMEOUT, 30);
            curl_setopt($curlHandle, CURLOPT_POST, 1);
            curl_exec($curlHandle);
            curl_close($curlHandle);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
