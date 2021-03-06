<?php

namespace Sinister;

class Exception extends \Exception
{
    public $httpCode = 500;
    
    public function __construct($message, $httpCode, $code = 0)
    {
        parent::__construct($message, $code);
        $this->httpCode = $httpCode;
    }
    
    public function __toString(){
    	return print_r($this, true);
    }
    
    public static function registerErrorHandler()
    {
        set_error_handler(function($code, $string, $file, $line){
            $e = new \Sinister\Exception($string, 500, $code);
            //$e->line = $line;
            //$e->file = $file;
            throw $e;
        });
    }
    
}
