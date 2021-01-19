<?php

namespace core\components\router;

use core\contracts\ComponentAbctract;
use core\contracts\ComponentFactoryAbstract;

class RouterFactory extends ComponentFactoryAbstract
{
    protected function createConcreteInstance($params = []): ComponentAbctract
    {
        return new Router();
    }
}