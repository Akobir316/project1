<?php


namespace core\components\logger;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class ErrorHandler
{
    private $logger;
    private static $fatalErrors = [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR, E_USER_ERROR];
    public function __construct(LoggerInterface $logger)
    {
        if(MODE){
            error_reporting(-1);
        }else{
            error_reporting(0);
        }
        $this->logger = $logger;
        set_error_handler([$this, 'errorHandler']);
        ob_start();
        register_shutdown_function([$this, 'fatalErrors']);
        set_exception_handler([$this, 'exceptionHandler']);
    }
    public function errorHandler($errnum, $errstr, $errfile, $errline){
        if(error_reporting() & $errnum){
           $levels = $this->defaultErrorLevel();
           $this->logger->log($levels[$errnum], $errstr, ['code'=>$errnum,'message'=>$errstr,'file'=>$errfile,'line'=>$errline]);
           $this->displayError(ucfirst($levels[$errnum])."[{$errnum}]", $errstr, $errfile, $errline);
        }
    }
    public function fatalErrors(){
        $error = error_get_last();
        $level = LogLevel::CRITICAL;
        if($error && in_array($error['type'], self::$fatalErrors, true)){
            $this->logger->log($level, "Fatal Error:".$error['message'],['code'=>$error['type'],'message'=>$error['message'],'file' => $error['file'], 'line' => $error['line']]);
            ob_end_clean();
            $this->displayError($error['type'],"Fatal Error:".$error['message'],$error['file'], $error['line'] );
        }else{
            ob_end_flush();
        }
    }
    public function exceptionHandler(\Exception $e){
        $level = LogLevel::ALERT;
        $this->logger->log($level, $e->getMessage() ,['exception' => $e]);
        $this->displayError($level.'(Исключение)', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    protected function defaultErrorLevel(): array
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
    protected function displayError($errnum, $errstr, $errfile, $errline, $responce = 500){

        http_response_code($responce);

        if($responce == 404 && !MODE){
            require WWW . '/errors/404.php';
        }
        if(MODE){
            require WWW . '/errors/dev.php';
        }else{
            require WWW . '/errors/prod.php';
        }
        die();
    }
}