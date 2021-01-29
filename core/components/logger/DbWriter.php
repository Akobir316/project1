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
     * @param $logdata
     */
    public function write($logdata)
    {
        //реализация запись в базу данных
    }
}