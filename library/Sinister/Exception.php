<?php

namespace Sinister;

class Exception extends \Exception
{
    
    public static function registerErrorHandler()
    {
        set_error_handler(array(new self(), 'exceptionsErrorHandler'));
    }
    
    public function exceptionsErrorHandler($code, $string, $file, $line) {
        $e = new self($string, $code);
        $e->line = $line;
        $e->file = $file;
        throw $e;
    }
    
}
