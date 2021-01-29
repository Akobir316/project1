<?php

namespace core\contracts;
/**
 * Interface ContainerInterface
 *
 * @package core\contracts
 */
interface ContainerInterface
{
    /**
     * Получает сервис с контейнера по его имени
     * @param $name
     * @return mixed
     */
    public function get($name);

    /**
     * Проверяет есть ли в контейнере зарегистрированный севрис по его имени
     * @param $name
     * @return mixed
     */
    public function has($name);
}