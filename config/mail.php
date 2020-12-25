<?php

return [
    'driver' => env('MAIL_DRIVER', 'smtp'),
    'host' => env('MAIL_HOST', 'mail.sorloza.com'),
    'port' => env('MAIL_PORT', 587),
    'from' => ['address' => 'test@sorloza.com', 'name' => 'sorloza.com'],
    'encryption' => env('MAIL_ENCRYPTION', 'tls'),
    'username' => env('MAIL_USERNAME','test@sorloza.com'),
    'password' => env('MAIL_PASSWORD','C8kt9q8&'),
    'sendmail' => '/usr/sbin/sendmail -bs',
    'pretend' => env('MAIL_PRETEND', false),

];
