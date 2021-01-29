<?php

namespace core;

/**
 * Trait Reflection
 * Этот trait через рефлекцию определяет какие параметры ожидает метод контроллера и передает параметры из http запроса в данный метод.
 *
 * @package core
 */
trait Reflection
{
    /**
     * Метод трейта который вызывает метод контроллера передавая ожидающие параметры.
     * Если метод контроллера не ожидает параметры то он просто вызывается
     *
     * @param object $controller
     * @param string $action
     * @return false|mixed
     * @throws \ReflectionException
     */
    public function reflectionMethod ($controller, $action)
    {
        //Получаем гет параметы
        $http_get = $_GET;
        $needParams = [];
        //Создаем объект класса ReflectionMethod
        $reflectionMethod = new \ReflectionMethod($controller, $action);
        //Получаем информацию о параметрах метода
        $methodParams = $reflectionMethod->getParameters();
        if (!empty($methodParams)) {

            foreach ($methodParams as $key=>$parametr) {
                foreach ($parametr as $v) {
                    if (array_key_exists($v, $http_get)) {
                         $needParams[$v] = $http_get[$v];
                    }
                }
            }

        return call_user_func_array([$controller, $action], $needParams);
        }
        return $controller->$action();
    }
}