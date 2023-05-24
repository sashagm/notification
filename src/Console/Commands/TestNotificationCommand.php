<?php

namespace Sashagm\Notification\Console\Commands;

use Illuminate\Console\Command;
use Sashagm\Notification\Services\NotificationService;


class TestNotificationCommand extends Command
{
    protected $signature = 'notification:test {type}';

    protected $description = 'Отправить тестовое уведомление ( передайте агрументом тип email/telegram )';

    public function handle()
    {
        $type = $this->argument('type');
        $message = 'Console - This is a test notification!';

        $notificationService = new NotificationService();

        switch ($type) {
            case 'email':
                $notificationService->sendEmail($message);
                $this->info('Console - Test email notification sent!');
                break;
            case 'telegram':
                $notificationService->sendTelegram($message);
                $this->info('Console - Test Telegram notification sent!');
                break;
            default:
                $this->error('Invalid notification type.');
        }
    }
}