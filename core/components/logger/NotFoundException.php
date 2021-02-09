<?php


namespace core\components\logger;

use Exception;

class NotFoundException extends Exception
{
    public function __construct($message = "", $code = 404)
    {
        parent::__construct($message, $code);
        http_response_code($code);
    }
}