<?php


return [


    'telegramApiKey'    =>  env('TELEGRAM_API_KEY'),
    'chatId'            => env('TELEGRAM_CHAT_ID'),
    'email'             => env('NF_EMAIL'),
    'vkToken'           => env('VK_TOKEN'),
    'vkUserId'          => env('VK_USER_ID'),
    'logger'            => true, // Разрешить логирование
    'logger_method'     => true,              // Использовать дефолтный вариант логирования(false - Кастомный логер)
    'logger_path'       => "logs/custom.log",  // Путь для кастомного логера


    'check'             => [

        'active'        => true, // True Разрешить проверку или false Пропускать проверку
        'guard'         => 'web', // Укажите через какой гард будет работать

        'save_colum'    => 'id', // Поле для группы/роли или прав
        'save_value'    => [
            1, 2, 3
        ], // добавляем массив значений

    ],
    
    'routes'            => [

        'url'           => env('NF_URL', '/notifications'),
        'routeName'     => env('NF_ROUTE_NAME', 'nf'),

    ],

];