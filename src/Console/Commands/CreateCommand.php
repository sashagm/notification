<?php

namespace Sashagm\Themes\Console\Commands;

use Illuminate\Console\Command;
use Sashagm\Themes\Models\Themes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Sashagm\Themes\Providers\ThemesServiceProvider;
use Sashagm\Notification\Services\NotificationService;

class CreateCommand extends Command
{
    protected $signature = 'notification:send {type} {message}';

    protected $description = 'Отправить тестовое уведомление ( передайте агрументом тип email/telegram и сообщение )';

    public function handle()
    {
        $type = $this->argument('type');
        $message = $this->argument('message');

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

