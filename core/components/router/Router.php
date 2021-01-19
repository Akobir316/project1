<?php

namespace core\components\router;
use core\contracts\ComponentAbctract;

class Router extends ComponentAbctract
{
    protected static $routes = [];
    protected static $route = [];

    public static function add($regexp, $route = [])
    {
        self::$routes[$regexp] = $route;
    }
    public static function route()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        $url = self::removeQueryString($url);
        if (self::matchRoute($url)) {
            $controller = "app\controllers\\" . self::$route['controller'] . "Controller";
            if (class_exists($controller)) {
                $controllerObj = new $controller(self::$route);
                $action = self::lowerCamelCase(self::$route['action']) . "Action";
                if (method_exists($controllerObj, $action)) {

                    return function() use ($controllerObj, $action) {
                        $controllerObj->$action();
                    };
                } else {
                    throw new \Exception("Метод $controller::$action не найден",404);
                }
            } else {
                throw new \Exception("Контроллер $controller не найден", 404);
            }

        } else {
           throw new \Exception("Страница не найдена", 404);
        }

    }
    public static function matchRoute($url)
    {
        foreach (self::$routes as $pattern => $route) {
            if (preg_match("#{$pattern}#i", $url, $matches)) {
                foreach ($matches as $k => $v) {
                    //определяем только строковые ключи
                    if (is_string($k)) {
                        $route[$k] = $v;
                    }
                }
                if (empty($route['action'])) {
                    $route['action'] = 'index';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }
    protected static function removeQueryString($url)
    {
        if ($url) {
            $params = explode('?',$url,2);
            if (!strpos($params[0], '=')) {
                return rtrim($params[0],'/');
            }
            return '';
        }
    }

    protected static function upperCamelCase($str)
    {
        //для контроллеров н-р page-new => PageNew
        return str_replace(" ", "", ucwords(str_replace("-", " ", $str)));
    }
    protected static function lowerCamelCase($str)
    {
        return lcfirst(self::upperCamelCase($str)); //для методов н-р view-new => viewNew
    }
    public function bootstrap()
    {

    }
}