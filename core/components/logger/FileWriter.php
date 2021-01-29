<?php


namespace core\components\logger;
/**
 * Class FileWriter
 * @package core\components\logger
 */

class FileWriter implements WriterInterface
{
    /**
     * Метод для записи в файл
     * @param $logdata
     */
    public function write($logdata)
    {
        $file = ROOT . '/tmp/errors.log';
        file_put_contents($file, $logdata, FILE_APPEND | LOCK_EX);
    }
}