<?php

namespace core\contracts;

interface FormaterInterface
{
   public function format($level, $message, $context);
}