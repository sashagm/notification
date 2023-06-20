<?php

namespace Sashagm\Notification\Services;

use Exception;
use GuzzleHttp\Client;
use VK\Client\VKApiClient;
use Illuminate\Support\Facades\Mail;

class NotificationService
{
    public function sendEmail($message, $id = null)
    {
        $to = $id ? $id : config('nf.email');

        Mail::raw($message, function ($message) use ($to) {
            $message->to($to)
                    ->subject('New Notification');
        });
    }

    public function sendTelegram($message, $chatId = null)
    {
        $telegramApiKey = config('nf.telegramApiKey');
        $chatId = $chatId ? $chatId : config('nf.chatId');

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


    public function sendVk($message)
    {
        
        
        
    }
    


    public function sendAll($message)
    {

        $this->sendEmail($message);
        $this->sendTelegram($message);

    }



}