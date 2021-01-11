<?php


namespace core\components\logger;


use core\contracts\WriterInterface;

class DbWriter implements WriterInterface
{

    public function write($logdata)
    {
        //реализация запись в базу данных
    }
}