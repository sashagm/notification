<?php

namespace Sashagm\Notification\Http\Controllers;

use Illuminate\Http\Request;
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

        if ($type == 'email') {
            $this->notificationService->sendEmail($message);
        } else if ($type == 'telegram') {
            $this->notificationService->sendTelegram($message);
        } else if ($type == 'vk') {
            $this->notificationService->sendVk($message);
        } else if ($type == 'all') {
            $this->notificationService->sendAll($message);
        } 
        
        else {
            return response()->json(['error' => 'Invalid notification type'], 400);
        }

        return response()->json(['success' => true]);
    }
}
