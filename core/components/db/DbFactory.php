<?php

namespace core\components\db;
/**
 * Class DbFactory
 * @package core\components\db
 */
use core\contracts\ComponentFactoryAbstract;
use core\contracts\ComponentInterface;


class DbFactory extends ComponentFactoryAbstract
{
    /**
     * @param array $params
     * @return ComponentInterface
     * @throws \Exception
     */
    protected function createConcreteInstance($params = []): ComponentInterface
    {

        if (empty($params['host']) || empty($params['user']) || empty($params['password']) || empty($params['db'])) {
            throw new \Exception('Params dsn, user and password are required');
        }

        return new Db($params['host'], $params['user'], $params['password'], $params['db']);
    }
}