<?php

namespace Sinister\Exception;

use Sinister\Exception;

class InvalidContentRequestFormatException extends Exception 
{
    public function __construct($message)
    {
        parent::__construct($message, 501);        
    }
}
