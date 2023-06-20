<?php


return [


    'telegramApiKey' =>  env('TELEGRAM_API_KEY'),
    'chatId' => env('TELEGRAM_CHAT_ID'),
    'email' => env('NF_EMAIL'),
    'vkToken' => env('VK_TOKEN'),
    'vkUserId' => env('VK_USER_ID'),
    'url' => env('NF_URL', '/notifications'),
    'routeName' => env('NF_ROUTE_NAME', 'nf'),

];