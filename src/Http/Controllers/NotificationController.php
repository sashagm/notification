<?php

namespace Sashagm\Notification\Http\Controllers;

use Illuminate\Http\Request;
use InvalidArgumentException;
use Sashagm\Notification\Services\NotificationService;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function send(Request $request)
    {
        $type = $request->input('type');
        $message = $request->input('message');
        $id = $request->input('id');

        if (!in_array($type, ['email', 'telegram', 'vk', 'all'])) {
            throw new InvalidArgumentException('Invalid notification type');
        }

        if ($type == 'email') {
            $this->notificationService->sendEmail($message, $id);
        } else if ($type == 'telegram') {
            $this->notificationService->sendTelegram($message, $id);
        } else if ($type == 'vk') {
            $this->notificationService->sendVk($message);
        } else if ($type == 'all') {
            $this->notificationService->sendAll($message);
        }

        return response()
                ->json(['success' => true]);
    }
}

