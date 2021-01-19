<?php

namespace core\contracts;

abstract class ComponentFactoryAbstract
{
    public function createInstance($params = []): ComponentInterface
    {
        return $this->createConcreteInstance($params);
    }
    protected abstract function createConcreteInstance($params = []): ComponentInterface;
}