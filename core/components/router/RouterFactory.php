<?php


namespace core\components\router;


use core\contracts\ComponentFactoryAbstract;

class RouterFactory extends ComponentFactoryAbstract
{

    protected function createConcreteInstance()
    {
        return new Router();
    }
}