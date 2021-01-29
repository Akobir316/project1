<?php

namespace core\contracts;
/**
 * Class ComponentFactoryAbstract
 * Абстрактный класс всех фабрик, умеющих создвать экземпляры сервисов.
 * Все сервисы должны создаваться с помощью фабрик
 * Каждая конкретаная фабрика сервиса должна реализовать метод createConcreteInstance
 * Паттерн Factory method
 *
 * @package core\contracts
 */
abstract class ComponentFactoryAbstract
{
    /**
     * @param array $params
     *  Публичный метод, для создания экземпляра сервиса
     * @return ComponentAbctract
     */
    public function createInstance($params = []): ComponentInterface
    {
        return $this->createConcreteInstance($params);
    }

    /**
     * @param array $params
     * Фабричный метод, для создания конкретных экземпляров сервисов
     * @return ComponentAbctract
     */
    protected abstract function createConcreteInstance($params = []): ComponentInterface;
}