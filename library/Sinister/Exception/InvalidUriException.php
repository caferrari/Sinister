<?php

namespace Sinister\Exception;

use Sinister\Exception;

class InvalidUriException extends Exception 
{
    public function __construct($message)
    {
        parent::__construct($message, 404);        
    }
}
