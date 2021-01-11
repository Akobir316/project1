<?php
namespace core;

use core\contracts\{BootstrapInterface,ContainerInterface,RunnableInterface};

class Application implements BootstrapInterface, ContainerInterface,RunnableInterface
{
    protected static $instance;
    protected $config;
    protected $components = [];
    protected $instances = [];
    public static function getInstance($config = [])
    {
        if (self::$instance === null) {
            self::$instance = new self($config);
        }
        return self::$instance;
    }

    protected function __construct($config = [])
    {
        $this->config = $config;
    }
    public function bootstrap()
    {
        if (!empty($this->config['components'])) {
            foreach ($this->config['components'] as $k => $v) {
                if (isset($v['factory']) && class_exists($v['factory'])) {
                    $this->components[$k] = $v['factory'];
                }
            }
        }
    }
    public function get($name)
    {
        if(isset($this->instances[$name])) {
            return $this->instances[$name];

        }
        if (array_key_exists($name, $this->components)) {
            $factory = new $this->components[$name];
            $instance = $factory->createInstance();
            $this->instances[$name] = $instance;

            return $instance;
        }

        return null;
    }
    public function has($name)
    {
        if (isset($this->instances[$name])) {
            return true;
        }
        if (isset($this->components[$name])) {
            return true;
        }
        return false;
    }
    public function run()
    {
        $this->bootstrap();
        $this->get('loger');
        $router = $this->get('router');
        if ($action = $router->route()){
            $action();
        }
    }
}