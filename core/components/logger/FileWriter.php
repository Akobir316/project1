<?php


namespace core\components\logger;


use core\contracts\WriterInterface;

class FileWriter implements WriterInterface
{

    public function write($logdata)
    {
        $file = ROOT.'/tmp/errors.log';
        file_put_contents($file, $logdata, FILE_APPEND | LOCK_EX);
    }
}