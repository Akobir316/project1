<?php
namespace core;

use core\contracts\{BootstrapInterface,ContainerInterface,RunnableInterface};


class Application implements BootstrapInterface, ContainerInterface,RunnableInterface
{
    protected static $instance;
    protected $config;
    protected $components = [];
    public static function getInstance($config)
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
                if (isset($v['class']) && class_exists($v['class'])) {
                    $instance = new $v['class'];
                    $this->components[$k] = $instance;
                }
            }
        }
    }
    public function get($name)
    {
        if (array_key_exists($name, $this->components)) {
            return $this->components[$name];
        }
        return null;
    }
    public function has($name)
    {

    }
    public function run()
    {
        $this->bootstrap();
        $router = $this->get('router');
        if ($action = $router->route()) {
            $action();
        }
       // var_dump($this->get('exceptions'));

    }

}