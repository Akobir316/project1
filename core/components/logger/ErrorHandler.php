<?php


namespace core\components\logger;


use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class ErrorHandler
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * ErrorHandler constructor.
     * @param LoggerInterface $logger
     */

    public function __construct(LoggerInterface $logger)
    {
        if (MODE) {
            error_reporting(-1);
        } else {
            error_reporting(0);
        }
        $this->logger = $logger;
        set_error_handler([$this, 'errorHandler']);
        ob_start();
        register_shutdown_function([$this, 'fatalErrors']);
        //set_exception_handler([$this, 'exceptionHandler']);
    }
    /**
     * Метод для перехвата не фатальных ошибок
     * @param $errnum
     * @param $errstr
     * @param $errfile
     * @param $errline
     */
    public function errorHandler($errnum, $errstr, $errfile, $errline)
    {
        if (error_reporting() & $errnum) {
            $levels = $this->defaultErrorLevel();
            $this->logger->log($levels[$errnum], $errstr, ['code' => $errnum,  'file' => $errfile, 'line' => $errline]);
            $this->displayError(ucfirst($levels[$errnum]), $errstr, $errfile, $errline);
        }
    }


    /**
     * Метод для перехвата фатальных ошибок
     */

    public function fatalErrors()
    {
        $error = error_get_last();
        if ($error && self::isFatal($error['type'])) {
            $levels = $this->defaultErrorLevel();
            $this->logger->log($levels[$error['type']], "Fatal" . $error['message'], ['code' => $error['type'], 'file' => $error['file'], 'line' => $error['line']]);
            ob_end_clean();
            $this->displayError('Fatal',$error['message'], $error['file'], $error['line']);
        } else {
            ob_end_flush();
        }
    }
    /**
     * @return array
     */
    protected static function defaultErrorLevel(): array
    {
        return [
            E_ERROR             => LogLevel::CRITICAL,
            E_WARNING           => LogLevel::WARNING,
            E_PARSE             => LogLevel::ALERT,
            E_NOTICE            => LogLevel::NOTICE,
            E_CORE_ERROR        => LogLevel::CRITICAL,
            E_CORE_WARNING      => LogLevel::WARNING,
            E_COMPILE_ERROR     => LogLevel::ALERT,
            E_COMPILE_WARNING   => LogLevel::WARNING,
            E_USER_ERROR        => LogLevel::ERROR,
            E_USER_WARNING      => LogLevel::WARNING,
            E_USER_NOTICE       => LogLevel::NOTICE,
            E_STRICT            => LogLevel::NOTICE,
            E_RECOVERABLE_ERROR => LogLevel::ERROR,
            E_DEPRECATED        => LogLevel::NOTICE,
            E_USER_DEPRECATED   => LogLevel::NOTICE,
        ];
    }
    /**
     * Метод для определения фатальных ошибок
     * @param $type
     * @return bool
     */
    protected static function isFatal($type)
    {
        return in_array($type, [E_COMPILE_ERROR, E_CORE_ERROR, E_ERROR, E_PARSE]);
    }
    /**
     * Метод для показа ошибок
     * @param $errnum
     * @param $errstr
     * @param $errfile
     * @param $errline
     * @param int $responce
     */
    protected function displayError($errnum, $errstr, $errfile, $errline, $responce = 500)
    {
        http_response_code($responce);
  /*      if ($responce == 404 && !MODE) {
            require WWW . '/errors/404.php';
        }*/
        if (MODE) {
            echo '<b>'.$errnum.'</b>'.': '.$errstr.': '.$errfile.': '.$errline;
        } else {
            require WWW . '/errors/prod.php';
        } die();
    }
}