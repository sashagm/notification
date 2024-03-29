<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">

<a href="https://packagist.org/packages/sashagm/notification"><img src="https://img.shields.io/packagist/dt/sashagm/notification" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/sashagm/notification"><img src="https://img.shields.io/packagist/v/sashagm/notification" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/sashagm/notification"><img src="https://img.shields.io/packagist/l/sashagm/notification" alt="License"></a>
<a href="https://packagist.org/packages/sashagm/notification"><img src="https://img.shields.io/github/languages/code-size/sashagm/notification" alt="Code size"></a>
<a href="https://packagist.org/packages/sashagm/notification"><img src="https://img.shields.io/packagist/stars/sashagm/notification" alt="Code size"></a>

[![PHP Version](https://img.shields.io/badge/PHP-%2B8-blue)](https://www.php.net/)
[![Laravel Version](https://img.shields.io/badge/Laravel-%2B10-red)](https://laravel.com/)

</p>

## Уведомления для Laravel
NotificationService - это компонент фреймворка Laravel, который позволяет уведомлять пользователей о различных событиях в приложении. Он предоставляет возможность отправки уведомлений на электронную почту или в Telegram-чаты.

Для использования NotificationService необходимо настроить переменные окружения для SMTP-сервера и токена бота Telegram. После этого можно создать уведомления, которые будут отправляться при наступлении определенных событий в приложении.

Уведомления могут быть созданы как классы, которые реализуют интерфейс Illuminate\Contracts\Notifications\ShouldQueue, так и анонимные функции. В уведомлениях можно задавать текст сообщения, тему, получателей и другие параметры.

NotificationService также предоставляет возможность использовать различные каналы для отправки уведомлений, например, SMS или Push-уведомления. Для этого необходимо настроить соответствующие каналы и добавить их в конфигурацию NotificationService.

В целом, NotificationService предоставляет удобный и гибкий способ уведомления пользователей о событиях в приложении, что может значительно повысить его удобство и функциональность.

NotificationService – это открытое программное обеспечение, распространяемое под лицензией MIT. Это означает, что вы можете использовать и модифицировать его свободно, без ограничений. 

Мы верим, что свобода и открытость являются ключевыми принципами разработки программного обеспечения, и поэтому мы выбрали лицензию MIT для NotificationService. Это дает пользователям и разработчикам полную свободу использовать, изменять и распространять наш продукт.

Мы надеемся, что NotificationService будет полезным для вас и вашей команды, и мы приглашаем вас внести свой вклад в его развитие. Если у вас есть какие-либо вопросы или предложения, пожалуйста, свяжитесь с нами – мы всегда рады помочь.

### Оглавление:

- [Требования](#требования)
- [Установка](#установка)
- [Использование](#использование)
  - [Права доступа](#права-доступа)
  - [Кастомный гард](#кастомный-гард)
  - [Кастомный логер](#кастомный-логер)   
- [Дополнительные возможности](#дополнительные-возможности)
- [Тестирование](#тестирование)
- [Лицензия](#лицензия)

#### Требования

Основные требования для установки и корректной работы:

- `PHP` >= 8.0
- `Laravel` >= 10.x
- `Composer` >= 2.4.x

#### Установка

Для установки пакета необходимо выполнить команды:

- composer require sashagm/notification
- php artisan notification:install


#### Использование

1. Для начала давайте определим нашу вспомогательную конфигурацию в `.env`:

```php
NF_EMAIL= 
TELEGRAM_API_KEY = 
TELEGRAM_CHAT_ID = 
NF_URL=/custom/notifications
NF_ROUTE_NAME=custom-nf
```

2. Теперь давайте определим нашу вспомогательную конфигурацию в `/config/nf.php`:

```php
    'telegramApiKey'    => env('TELEGRAM_API_KEY'),
    'chatId'            => env('TELEGRAM_CHAT_ID'),
    'email'             => env('NF_EMAIL'),
    'vkToken'           => env('VK_TOKEN'),
    'vkUserId'          => env('VK_USER_ID'),
    'logger'            => true, // Разрешить логирование

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
```



3. Например, чтобы отправить уведомление на почту, отправьте POST запрос на `route('nf')` со следующими параметрами:

```php
{
    "type": "email", // для отправки на почту
    "message": "Hello, world!"
    //'id': 'example@domain.com' email, 12345678 чат ид
    // id не обязательный парамтр если он не передан то уведомление будет отправлены по дефолтным данным из .env
}
```

либо 

```php
{
    "type": "telegram", // для отправки в телеграм
    "message": "Hello, world!"
    //'id': 'example@domain.com' email, 12345678 чат ид
    // id не обязательный парамтр если он не передан то уведомление будет отправлены по дефолтным данным из .env
}
```
4.  Чтобы отправить уведомление на все каналы, отправьте POST запрос на `route('nf')` со следующими параметрами:


```php
{
    "type": "all", // для отправки в все каналы
    "message": "Hello, world!"
}
```

5. Вы можете отправлять уведомления из любого места в вашем приложении, не только из контроллера. Для этого вам нужно создать экземпляр `NotificationService` и вызвать методы `sendEmail`, `sendTelegram` или `sendAll`, как мы это делали в команде Artisan.

Например, вы можете отправить уведомление на электронную почту в следующем коде:

```php
use Sashagm\Notification\Services\NotificationService;

$notificationService = new NotificationService();
$message = 'This is a test email notification.';
$notificationService->sendEmail($message);
```

Аналогично, вы можете отправить уведомление в Telegram:

```php
use Sashagm\Notification\Services\NotificationService;

$notificationService = new NotificationService();
$message = 'This is a test Telegram notification.';
$notificationService->sendTelegram($message);
```

Так же можно отправить во все канылы:

```php
use Sashagm\Notification\Services\NotificationService;

$notificationService = new NotificationService();
$message = 'This is a test all chanel notification.';
$notificationService->sendAll($message);

```


Просто убедитесь, что вы импортировали класс `NotificationService` в ваш файл.

#### Права доступа

Если необходимо ограничить доступ можно в конфигурации  `/config/nf.php` изменить права доступа в разделе `check`:


```php

    'check'             => [

        'active'        => true, // True Разрешить проверку или false Пропускать проверку
        'guard'         => 'web', // Укажите через какой гард будет работать

        'save_colum'    => 'id', // Поле для группы/роли или прав
        'save_value'    => [
            1, 2, 3
        ], // добавляем массив значений

    ],

```

Добавляем массив с значениями для разных вариаций. Например для данного примера показано что пользователи с id `1,2,3` имеют права доступа.
Так же можно указать не id а roles, тогда можно настроить на группы/роли пользователей например `Админ, Модер, Редактор`.


#### Кастомный гард

Если необходимо использовать кастомный гард можно в конфигурации  `/config/nf.php` изменить в разделе `check` за это отвечает параметр `guard` по дефолту настроен на `web` и возвращает текущего аутентифицированного пользователя для стандартной охраны web. Это используется для аутентификации пользователей, которые входят через веб-интерфейс.

Если указать кастомный гард то будет возвращать текущего аутентифицированного пользователя для охраны с именем кастомного гарда. Охрана с именем кастомного гарда может быть настроена в файле конфигурации Laravel для использования другой базы данных или другой модели пользователя.

Таким образом можно изменять подходящий гард для проверки прав доступа для Middleware тем.

#### Кастомный логер

Если вы не хотите использовать стандартный файл для логирования, вы можете использовать отдельный файл и записывать данные логов туда.
Просто измените путь до нового файла в конфигурации  `/config/nf.php` 

```php

    'logger_method'     => true,              // Использовать дефолтный вариант логирования(false - Кастомный логер)
    'logger_path'       => "logs/custom.log",  // Путь для кастомного логера
    
```

#### Дополнительные возможности

Наш пакет предоставляет ряд дополнительных возможностей, которые могут быть полезны при работе с уведомлениями:

- `php artisan notification:install` - Данная команда установит все необходимые файлы.

- `php artisan notification:test {type}` - Данная команда отправит тестовое уведомление на выбранный канал (email,telegram,all).

- `php artisan notification:send {type} {message}  {--id=0}` - Данная команда отправит тестовое уведомление на выбранный канал с вашем сообщением (email,telegram, all). Для указания id можно отправить только либо на `email` своим адресом либо в `telegram` на свой ид чат.

#### Тестирование

Для проверки работоспособности можно выполнить специальную команду:

- ./vendor/bin/phpunit --configuration phpunit.xml

#### Лицензия

Laravel Notification - это программное обеспечение с открытым исходным кодом, лицензированное по [MIT license](LICENSE.md ).
