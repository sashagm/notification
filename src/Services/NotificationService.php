<?php

namespace Sashagm\Notification\Services;

use Exception;
use GuzzleHttp\Client;
use VK\Client\VKApiClient;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Sashagm\Notification\Traits\BuildsLoggers;

class NotificationService
{
    use BuildsLoggers;

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

        $this->logNotification("Email");
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

        $this->logNotification("Telegram");
    }

    public function sendVk($message, $vkApiKey = null)
    {
        $vkApiKey = $vkApiKey ? $vkApiKey : config('nf.vkApiKey');

        if (!$vkApiKey) {
            throw new \Exception('VK API key is not set');
        }

        // Send VK message

        $this->logNotification("Vk");
    }

    public function sendAll($message)
    {
        $this->sendEmail($message);
        $this->sendTelegram($message);
        // $this->sendVk($message);
        $this->logNotification("All");
    }

    protected function createHttpClient()
    {
        return new Client([
            'base_uri' => 'https://api.telegram.org/',
            'timeout'  => 2.0,
        ]);
    }

    private function logNotification($channel)
    {
        $loggerConfig = config('nf.logger');

        if ($loggerConfig) {
            // Write a log that notifications have been sent
            // For example, you can use the Laravel Log facade:
            $this->logger('info', "All notifications have been sent to the specified channels: $channel!");

        
        }
    }
}
