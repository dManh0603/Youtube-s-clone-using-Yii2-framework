<?php

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=192.168.1.112:4006;dbname=noobtube',
            'username' => 'meuclip',
            'password' => 'Aladin@123',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.mailtrap.io',
                'username' => '8146da70abaf0f',
                'password' => '5da7822c776fae',
                'port' => '2525',
                'encryption' => 'tls',
            ],
        ],
    ],
];
