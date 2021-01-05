<?php
namespace core;

use core\contracts\{BootstrapInterface,ContainerInterface,RunnableInterface};


class Application implements BootstrapInterface, ContainerInterface,RunnableInterface
{
    private static $instance;

    public static function getInstance(){
        if(self::$instance === null){
            self::$instance = new self();
        }
        return self::$instance;
    }
    public function run()
    {
        Router::route();
    }

    public function bootstrap()
    {

    }
    public function get()
    {

    }
    public function has()
    {

    }

}