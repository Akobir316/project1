<?php

namespace core\components\logger;

interface FormaterInterface
{
   public function format($level, $message, $context);
}