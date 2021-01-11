<?php


namespace core\components\logger;


use core\contracts\FormaterInterface;

class Formater implements FormaterInterface
{

    public function format($message, $context)
    {
        if(!empty($context)){
            if(array_key_exists('exception', $context)){
                 $e = $context['exception'];
                 $line = "[".date('Y-m-d H:i:s')."] {Исключение} Текст ошибки: {$e->getMessage()} | Файл: {$e->getFile()} | Строка: {$e->getLine()}\n=================\n";
                 return $line;
             }
            $line = "[".date('Y-m-d H:i:s')."]{$context['code']} Текст ошибки: {$context['message']} | Файл: {$context['file']} | Строка: {$context['line']}\n=================\n";
            return $line;
        }
        $line = "[".date('Y-m-d H:i:s')."] {$message}\n=================\n";
        return $line;
    }
}