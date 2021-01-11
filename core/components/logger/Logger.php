<?php


namespace core\components\logger;

use Psr\Log\AbstractLogger;

class Logger extends AbstractLogger
{

    protected $formater;
    protected $writer;
    public function __construct(Formater $formater, object $writer)
    {
        new ErrorHandler($this);
        $this->formater = $formater;
        $this->writer = $writer;

    }

    public function log($level, $message, array $context = array())
    {
        $logdata = $this->formater->format($message,$context);
        $this->writer->write($logdata);
    }
}