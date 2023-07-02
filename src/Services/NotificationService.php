<?php

namespace Sashagm\Notification\Services;

use Exception;
use GuzzleHttp\Client;
use VK\Client\VKApiClient;
use Illuminate\Support\Facades\Mail;

class NotificationService
{
    protected $httpClient;

    public function __construct()
    {
        $this->httpClient = $this->createHttpClient();
    }

    public function sendEmail($message, $id = null)
    {
        $to = $id ? $id : config('nf.email');

        if (!$to) {
            throw new \Exception('Email address is not set');
        }

        Mail::raw($message, function ($message) use ($to) {
            $message->to($to)
                    ->subject('New Notification');
        });
    }

    public function sendTelegram($message, $chatId = null)
    {
        $telegramApiKey = config('nf.telegramApiKey');
        $chatId = $chatId ? $chatId : config('nf.chatId');

        if (!$chatId) {
            throw new \Exception('Telegram chatId is not set');
        }

        $response = $this->httpClient->request('POST', "https://api.telegram.org/bot$telegramApiKey/sendMessage", [
            'form_params' => [
                'chat_id' => $chatId,
                'text' => $message,
            ]
        ]);

        if ($response->getStatusCode() != 200) {
            throw new \Exception('Failed to send Telegram message');
        }
    }

    public function sendVk($message, $vkApiKey = null)
    {
        $vkApiKey = $vkApiKey ? $vkApiKey : config('nf.vkApiKey');

        if (!$vkApiKey) {
            throw new \Exception('VK API key is not set');
        }

        // Send VK message
    }

    public function sendAll($message)
    {
        $this->sendEmail($message);
        $this->sendTelegram($message);
       // $this->sendVk($message);
    }

    protected function createHttpClient()
    {
        return new Client([
            'base_uri' => 'https://api.telegram.org/',
            'timeout'  => 2.0,
        ]);
    }
}
