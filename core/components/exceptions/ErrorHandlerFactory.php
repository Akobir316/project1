<?php


namespace core\components\exceptions;

use core\contracts\ComponentFactoryAbstract;

class ErrorHandlerFactory extends ComponentFactoryAbstract
{

    protected function createConcreteInstance()
    {
        return new ErrorHandler();
    }
}