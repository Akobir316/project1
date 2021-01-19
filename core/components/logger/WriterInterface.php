<?php

namespace core\components\logger;

interface WriterInterface
{
    public function write($logdata);
}