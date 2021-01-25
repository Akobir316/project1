<?php


namespace core;

trait Reflection
{
    public function reflectionMethod ($controller, $action)
    {

        $http_get = $_GET;
        $needParams = [];
        $reflectionMethod = new \ReflectionMethod($controller, $action);
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