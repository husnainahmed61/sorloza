<?php

return [
    'driver' => env('MAIL_DRIVER', 'smtp'),
    'host' => env('MAIL_HOST', 'smtp.gmail.com'),
    'port' => env('MAIL_PORT', 587),
    'from' => ['address' => 'fayazabbasi498@gmail.com', 'name' => 'sample'],
    'encryption' => env('MAIL_ENCRYPTION', 'tls'),
    'username' => env('MAIL_USERNAME',''),
    'password' => env('MAIL_PASSWORD',''),
    'sendmail' => '/usr/sbin/sendmail -bs',
    'pretend' => env('MAIL_PRETEND', false),

];