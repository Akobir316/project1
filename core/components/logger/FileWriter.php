<?php


namespace core\components\logger;
/**
 * Class FileWriter
 * @package core\components\logger
 */

class FileWriter implements WriterInterface
{

    protected $logFile;

    public function __construct($logFile)
    {
        $this->logFile = $logFile;
    }
    /**
     * Метод для записи в файл
     * @param $message
     */
    public function write($message)
    {

        file_put_contents($this->logFile, $message, FILE_APPEND | LOCK_EX);
    }
}