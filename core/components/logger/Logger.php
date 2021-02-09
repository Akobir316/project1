<?php

namespace core\components\logger;
/**
 * Class Logger
 * Класс который может логировать что то ...
 * @package core\components\logger
 */
use core\contracts\ComponentInterface;
use Psr\Log\AbstractLogger;


class Logger extends AbstractLogger implements ComponentInterface
{
    /**
     * @var FormaterInterface Обьект, который умеет определенным образом форматировать логи
     */
    protected $formatter;
    /**
     * @var WriterInterface Обьект, который умеет писать логи в определенное хранилище
     */
    protected $writer;

    /**
     * Logger constructor.
     * @param FormaterInterface $formatter
     * @param WriterInterface $writer
     */
    public function __construct(FormaterInterface $formatter, WriterInterface $writer)
    {
        //Можно автоматически логировать все ошибки
        new ErrorHandler($this);
        $this->formatter = $formatter;
        $this->writer = $writer;
    }

    /**
     * @param mixed $level
     * @param string $message
     * @param array $context
     */
    public function log($level, $message, array $context = array())
    {

        $log_message = $this->formatter->format($level, $message, $context);
        $this->writer->write($log_message);
    }
    public function bootstrap()
    {

    }
}