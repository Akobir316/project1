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
        $this->bootstrap();
    }
    public function bootstrap()
    {
        if (!empty($this->config['components'])) {

            foreach ($this->config['components'] as $key => $item) {
                if (isset($item['factory']) && class_exists($item['factory'])) {
                    $this->components[$key] = $item;
                }
            }
        }
    }
    public function get($name)
    {
        if (isset($this->instances[$name])) {
            return $this->instances[$name];

        }
        if (array_key_exists($name, $this->components)) {
            $factory = new $this->components[$name]['factory'];
            $params = $this->components[$name]['params'] ?? [];
            $instance = $factory->createInstance($params);

            $instance->bootstrap();
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
        if ($action = $router->route()) {
            $action();
        }
    }
}