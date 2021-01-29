<?php

namespace core\components\logger;
/**
 * Interface FormaterInterface
 * @package core\components\logger
 */
interface FormaterInterface
{
    /**
     * @param $level
     * @param $message
     * @param $context
     * @return mixed
     */
   public function format($level, $message, $context);
}