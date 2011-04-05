<?php

namespace Sinister\Exception;

use Sinister\Exception;

class ViewNotFoundException extends Exception 
{
    public function __construct($message)
    {
        parent::__construct($message, 500);        
    }
}
