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
    protected $formater;
    /**
     * @var WriterInterface Обьект, который умеет писать логи в определенное хранилище
     */
    protected $writer;

    /**
     * Logger constructor.
     * @param Formater $formater
     * @param WriterInterface $writer
     */
    public function __construct(Formater $formater, WriterInterface $writer)
    {
        //Можно автоматически логировать все ошибки
        new ErrorHandler($this);
        $this->formater = $formater;
        $this->writer = $writer;
    }

    /**
     * @param mixed $level
     * @param string $message
     * @param array $context
     */
    public function log($level, $message, array $context = array())
    {
        $logdata = $this->formater->format($level, $message, $context);
        $this->writer->write($logdata);
    }
    public function bootstrap()
    {

    }
}