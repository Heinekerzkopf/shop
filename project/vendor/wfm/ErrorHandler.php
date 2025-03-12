<?php

namespace wfm;

use Throwable;

class ErrorHandler {

    public function __construct()
    {
        if (DEBUG) {
            error_reporting(-1);
        } else {
            error_reporting(0);
        }
        set_exception_handler([$this, 'exceptionHandler']);
        set_error_handler([$this, 'errorHandler']);
        ob_start();
        register_shutdown_function([$this, 'fatalErrorHandler']);
    }

    public function errorHandler($errno, $errstr, $errfile, $errline) {
        $this->logError($errstr, $errfile, $errline);
        $this->displayError($errno, $errstr, $errfile, $errline);
    }

    public function fatalErrorHandler() {
        $error = error_get_last();

        if (!empty($error) && $error['type'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR)) {
            $this->logError($error['message'], $error['file'], $error['line']);
            ob_end_clean();
            $this->displayError($error['type'], $error['message'], $error['file'], $error['line']);
        } else {
            ob_end_flush();
        }
    }

    public function exceptionHandler(Throwable $e) {
        $this->logError($e->getMessage(), $e->getFile(), $e->getLine());
        $response = $e->getCode() ?: 500; 
        $this->displayError('Exception', $e->getMessage(), $e->getFile(), $e->getLine(), $response);
    }

    protected function logError($message = '', $file = '', $line = '') {
        file_put_contents(LOGS . '/errors.log', 
            "[" . date('Y-m-d H:i:s') . "] Error message: {$message} | File: {$file} | Line: {$line}\n============\n",
            FILE_APPEND);
    }

    protected function displayError($errno, $errstr, $errfile, $errline, $response = 500) {
        if ($response == 0) {
            $response = 404;
        }
        http_response_code($response);
        
        $errorPage = DEBUG ? 'development.php' : 'production.php';
    
        if ($response == 404) {
            $errorPage = '404.php';
        }
    
        require WWW . "/errors/{$errorPage}";
        die;
    }
    

}