<?php

namespace core\components\logger;

use core\contracts\ComponentInterface;
use Psr\Log\AbstractLogger;

class Logger extends AbstractLogger implements ComponentInterface
{
    protected $formater;
    protected $writer;
    public function __construct(Formater $formater, WriterInterface $writer)
    {
        new ErrorHandler($this);
        $this->formater = $formater;
        $this->writer = $writer;
    }
    public function log($level, $message, array $context = array())
    {
        $logdata = $this->formater->format($level, $message, $context);
        $this->writer->write($logdata);
    }
    public function bootstrap()
    {

    }
}