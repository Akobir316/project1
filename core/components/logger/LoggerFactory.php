<?php

namespace core\components\logger;
/**
 * Class LoggerFactory
 * Фабрика логера
 * @package core\components\logger
 */
use core\contracts\ComponentFactoryAbstract;
use core\contracts\ComponentInterface;


class LoggerFactory extends ComponentFactoryAbstract
{
    /**
     * @param array $params
     * @return ComponentInterface
     */
    protected function createConcreteInstance($params = []): ComponentInterface
    {
        return new Logger(new Formater(), new FileWriter());
    }
}