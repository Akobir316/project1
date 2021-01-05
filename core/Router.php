<?php


namespace core;
use core\contracts\ComponentAbctract;
class Router extends ComponentAbctract
{
    protected static $routes = [];
    protected static $route = [];

    public static function add($regexp, $route = []){
        self::$routes[$regexp] = $route;
    }
    public static function route(){
        $url = trim($_SERVER['REQUEST_URI'], '/');

        if(self::matchRoute($url)){
            $controller = "app\controllers\\".self::$route['controller']."Controller";
            if(class_exists($controller)){
                $controllerObj = new $controller(self::$route);
                $action = self::lowerCamelCase(self::$route['action'])."Action";
                if(method_exists($controllerObj, $action)){
                    $controllerObj->$action();
                }else{
                    //Исключение(данный метод в контроллере не найден)
                }
            }else{
                //Исключение(контроллер не найден)

            }
        }else{

            //Исключение(404)
        }

    }
    public static function matchRoute($url){
        foreach (self::$routes as $pattern=>$route){
            if(preg_match("#{$pattern}#i", $url, $matches)){
                foreach ($matches as $k=>$v){
                    //определяем только строковые ключи
                    if(is_string($k)){
                        $route[$k] = $v;
                    }
                }
                if(empty($route['action'])){
                    $route['action'] = 'index';
                }
                $route['controller'] = self::upperCamelCase($route['controller']);
                self::$route = $route;
                return true;
            }
        }
        return false;
    }
    protected static function upperCamelCase($str){
        return str_replace(" ", "", ucwords(str_replace("-", " ", $str)));
    }
    protected static function lowerCamelCase($str){
        return lcfirst(self::upperCamelCase($str));
    }
}