<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">

<a href="https://packagist.org/packages/sashagm/notification"><img src="https://img.shields.io/packagist/dt/sashagm/notification" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/sashagm/notification"><img src="https://img.shields.io/packagist/v/sashagm/notification" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/sashagm/notification"><img src="https://img.shields.io/packagist/l/sashagm/notification" alt="License"></a>
<a href="https://packagist.org/packages/sashagm/notification"><img src="https://img.shields.io/github/languages/code-size/sashagm/notification" alt="Code size"></a>
<a href="https://packagist.org/packages/sashagm/notification"><img src="https://img.shields.io/packagist/stars/sashagm/notification" alt="Code size"></a>
</p>


## Уведомления для Laravel
NotificationService - это компонент фреймворка Laravel, который позволяет уведомлять пользователей о различных событиях в приложении. Он предоставляет возможность отправки уведомлений на электронную почту или в Telegram-чаты.

Для использования NotificationService необходимо настроить переменные окружения для SMTP-сервера и токена бота Telegram. После этого можно создать уведомления, которые будут отправляться при наступлении определенных событий в приложении.

Уведомления могут быть созданы как классы, которые реализуют интерфейс Illuminate\Contracts\Notifications\ShouldQueue, так и анонимные функции. В уведомлениях можно задавать текст сообщения, тему, получателей и другие параметры.

NotificationService также предоставляет возможность использовать различные каналы для отправки уведомлений, например, SMS или Push-уведомления. Для этого необходимо настроить соответствующие каналы и добавить их в конфигурацию NotificationService.

В целом, NotificationService предоставляет удобный и гибкий способ уведомления пользователей о событиях в приложении, что может значительно повысить его удобство и функциональность.

### Оглавление:

- [Установка](#установка)
- [Использование](#использование)
- [Дополнительные возможности](#дополнительные-возможности)
- [Тестирование](#тестирование)
- [Лицензия](#лицензия)

#### Установка

Для установки пакета необходимо выполнить команды:

- composer require sashagm/notification


#### Использование

1. Для начала давайте определим нашу вспомогательную конфигурацию в `.env`:

```php
NF_EMAIL= 
TELEGRAM_API_KEY = 
TELEGRAM_CHAT_ID = 
NF_URL=/custom/notifications
NF_ROUTE_NAME=custom-nf
```

2. Например, чтобы отправить уведомление на почту, отправьте POST запрос на `route('nf')` со следующими параметрами:

```php
{
    "type": "email", // для отправки на почту
    "message": "Hello, world!"
}
```

либо 

```php
{
    "type": "telegram", // для отправки в телеграм
    "message": "Hello, world!"
}
```
3.  Чтобы отправить уведомление на все каналы, отправьте POST запрос на `route('nf')` со следующими параметрами:


```php
{
    "type": "all", // для отправки в все каналы
    "message": "Hello, world!"
}
```

4. Вы можете отправлять уведомления из любого места в вашем приложении, не только из контроллера. Для этого вам нужно создать экземпляр `NotificationService` и вызвать методы `sendEmail`, `sendTelegram` или `sendAll`, как мы это делали в команде Artisan.

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



#### Дополнительные возможности

Наш пакет предоставляет ряд дополнительных возможностей, которые могут быть полезны при работе с уведомлениями:

- `php artisan notification:test {type}` - Данная команда отправит тестовое уведомление на выбранный канал (email,telegram,all).

- `php artisan notification:send {type} {message}  {--id=0}` - Данная команда отправит тестовое уведомление на выбранный канал с вашем сообщением (email,telegram, all). Для указания id можно отправить только либо на `email` своим адресом либо в `telegram` на свой ид чат.

#### Тестирование

Для проверки работоспособности можно выполнить специальную команду:

- ./vendor/bin/phpunit --configuration phpunit.xml

#### Лицензия

Laravel Notification - это программное обеспечение с открытым исходным кодом, лицензированное по [MIT license](LICENSE.md ).
