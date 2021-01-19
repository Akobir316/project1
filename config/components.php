<?php

use core\components\db\DbFactory;
use core\components\router\RouterFactory;

use core\components\logger\LoggerFactory;
return [
    'components'=>[
        'router'=>[
            'factory'=>RouterFactory::class,
            'params'=>[]
        ],
        'loger'=>[
            'factory'=>LoggerFactory::class,
            'params'=>[]
        ],
        'db' => [
            'factory' => DbFactory::class,
            'params' => [
                'dsn' => 'test',
                'user' => 'root',
                'password' => 'hello'
            ]
        ]
    ]
];