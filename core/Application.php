<?php

namespace core;
use core\contracts\BootstrapInterface;
use core\contracts\ContainerInterface;
use core\contracts\RunnableInterface;

/**
 * Class Application
 * Класс прилоежния - контейнер, который содержит различные сервисы.
 * @package core
 */



class Application implements BootstrapInterface, ContainerInterface,RunnableInterface
{
    /**
     * @var Application Экземпляр приложения
     */

    protected static $instance;

    /**
     * @var array Массив конфигураций
     */

    protected $config;

    /**
     * @var array Массив привязок названий сервисов и фабрик, которые умеют создавать экземпляры этих сервисов
     */

    protected $components = [];

    /**
     * @var array Массив экземпляров сервисов.
     * При создании нового сервиса, экземпляр записывается в этот массив с ключом, который указан в конфиге
     */

    protected $instances = [];

    /**
     * Метод для получения экземпляра приложения.
     * Паттерн Singleton
     *
     * @param array $config
     * @return Application
     */

    public static function getInstance($config = [])
    {
        if (self::$instance === null) {
            self::$instance = new self($config);
        }
        return self::$instance;
    }

    /**
     * Application constructor.
     *
     * @param array $config
     */

    protected function __construct($config = [])
    {
        $this->config = $config;
        $this->bootstrap();
    }

    /**
     * Метод для привязки имени сервиса с фабрикой, который умеет создавать экземпляр севриса
     */
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

    /**
     * Метод контейнера, который  по имени сервиса умеет создавать и/или возвращать уже готовый экземпляр сервиса
     *
     * @param $name
     * @return mixed|null
     */
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
    /**
     * Метод проверяет есть ли зарегистрированный или уже созданный сервис в контейнере
     *
     * @param $name
     * @return bool
     */
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

    // Подключаем трейт Reflection
    use Reflection;
    /**
     * Метод для запуска приложения
     */
    public function run()
    {
        $this->bootstrap();
        $this->get('loger');
        $router = $this->get('router');
        $param = $router->route();
        $this->reflectionMethod($param['controller'], $param['action']);
    }
}