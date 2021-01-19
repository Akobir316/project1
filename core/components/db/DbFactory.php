<?php

namespace core\components\db;

use core\contracts\ComponentFactoryAbstract;
use core\contracts\ComponentInterface;

class DbFactory extends ComponentFactoryAbstract
{

    protected function createConcreteInstance($params = []): ComponentInterface
    {
        if (empty($params['dsn']) || empty($params['user']) || empty($params['password'])) {
            throw new \Exception('Params dsn, user and password are required');
        }
        return new Db($params['dsn'], $params['user'], $params['password']);
    }
}