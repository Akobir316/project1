<?php

namespace core\components\router;
/**
 * Class RouterFactory
 * Фабрика Роутера
 * @package core\components\router
 */
use core\contracts\ComponentAbctract;
use core\contracts\ComponentFactoryAbstract;


class RouterFactory extends ComponentFactoryAbstract
{
    /**
     * @param array $params
     * @return ComponentAbctract
     */
    protected function createConcreteInstance($params = []): ComponentAbctract
    {
        return new Router();
    }
}