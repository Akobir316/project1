<?php
use core\components\router\RouterFactory;
use core\components\exceptions\ErrorHandlerFactory;
use core\components\logger\LogerFactory;
return [
    'components'=>[
        'router'=>[
            'factory'=>RouterFactory::class
        ],
//        'exceptions'=>[
//            'factory'=>ErrorHandlerFactory::class
//        ],
        'loger'=>[
            'factory'=>LogerFactory::class
        ]
    ]
];