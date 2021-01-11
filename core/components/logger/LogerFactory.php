<?php

namespace core\components\logger;
use core\contracts\ComponentFactoryAbstract;

class LogerFactory extends ComponentFactoryAbstract
{

    protected function createConcreteInstance()
    {
        return new Logger(new Formater(), new FileWriter());
    }
}