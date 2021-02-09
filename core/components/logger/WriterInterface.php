<?php

namespace core\components\logger;
/**
 * Interface WriterInterface
 * @package core\components\logger
 */
interface WriterInterface
{
    public function write($message);
}