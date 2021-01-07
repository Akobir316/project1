<?php
use core\{Router,ErrorHandler};
return [
    'components'=>[
        'router'=>[
            'class'=>Router::class
        ],
        'exceptions'=>[
            'class'=>ErrorHandler::class
        ]
    ]
];