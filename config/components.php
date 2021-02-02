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
        'logger'=>[
            'factory'=>LoggerFactory::class,
            'params'=>[]
        ],
        'db' => [
            'factory' => DbFactory::class,
            'params' => [
                'host' => 'localhost',
                'user' => 'root',
                'password' => '123321',
                'db' => 'example'
            ]
        ]
    ]
];