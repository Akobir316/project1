<?php


namespace core\components\logger;
/**
 * Class DbWriter
 * @package core\components\logger
 */
class DbWriter implements WriterInterface
{
    /**
     * Метод для записи в базу данных
     * @param $message
     */
    public function write($message)
    {
        //реализация запись в базу данных
    }
}