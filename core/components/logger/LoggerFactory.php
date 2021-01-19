<?php

namespace core\components\logger;
use core\contracts\ComponentFactoryAbstract;
use core\contracts\ComponentInterface;

class LoggerFactory extends ComponentFactoryAbstract
{
    protected function createConcreteInstance($params = []): ComponentInterface
    {
        return new Logger(new Formater(), new FileWriter());
    }
}