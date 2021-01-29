<?php


namespace core\components\logger;
/**
 * Class Formater
 * Класс для формитирования логов для записи
 * @package core\components\logger
 */

class Formater implements FormaterInterface
{
    /**
     * Метод форматирует лог для записи
     * @param $level
     * @param $message
     * @param $context
     * @return string
     */
    public function format($level, $message, $context)
    {
        if (!empty($context)) {
            if (array_key_exists('exception', $context)) {
                 $e = $context['exception'];
                 $line = "[" . date('Y-m-d H:i:s') . "] {Исключение} Текст ошибки: {$e->getMessage()} | Файл: {$e->getFile()} | Строка: {$e->getLine()}\n=================\n";
                 return $line;
             }
            $line = "[" . date('Y-m-d H:i:s') . "]{$context['code']} Текст ошибки: {$context['message']} | Файл: {$context['file']} | Строка: {$context['line']}\n=================\n";
            return $line;
        }
        $line = "[" . date('Y-m-d H:i:s') . "]{$level}" . " : " . "{$message}\n=================\n";
        return $line;
    }
}