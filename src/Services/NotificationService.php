<?php

namespace Sashagm\Notification\Services;

use Illuminate\Support\Facades\Mail;
use GuzzleHttp\Client;

class NotificationService
{
    public function sendEmail($message)
    {
        Mail::raw($message, function ($message) {
            $message->to(config('nf.email'))
                    ->subject('New Notification');
        });
    }

    public function sendTelegram($message)
    {
        $telegramApiKey = config('nf.telegramApiKey');
        $chatId = config('nf.chatId');

        $client = new Client([
            'base_uri' => 'https://api.telegram.org/',
            'timeout'  => 2.0,
        ]);

        $response = $client->request('POST', "https://api.telegram.org/bot$telegramApiKey/sendMessage", [
            'form_params' => [
                'chat_id' => $chatId,
                'text' => $message,
            ]
        ]);

        if ($response->getStatusCode() != 200) {
            throw new \Exception('Failed to send Telegram message');
        }
    }
}