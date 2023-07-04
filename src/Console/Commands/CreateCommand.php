<?php

namespace Sashagm\Notification\Console\Commands;

use Illuminate\Console\Command;
use Sashagm\Notification\Services\NotificationService;

class CreateCommand extends Command
{

    protected $signature = 'notification:send {type} {message} {--id=0}';

    protected $description = 'Отправить тестовое уведомление ( передайте агрументом тип email/telegram и сообщение, для id(email/tg chat))';

    public function handle()
    {
        $type = $this->argument('type');
        $message = $this->argument('message');
        $id = $this->option('id');

        $notificationService = new NotificationService();

        switch ($type) {
            case 'email':
                $notificationService->sendEmail($message, $id);
                $this->info('Console - Test email notification sent!');
                break;
            case 'telegram':
                $notificationService->sendTelegram($message, $id);
                $this->info('Console - Test Telegram notification sent!');
                break;
                case 'all':
                    $notificationService->sendTelegram($message);
                    $notificationService->sendEmail($message);
                    $this->info('Console - Test All chanel notification sent!');
                    break;
    

            default:
                $this->error('Invalid notification type.');
        }
    }
}

