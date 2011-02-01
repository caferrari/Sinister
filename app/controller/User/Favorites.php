<?php

namespace User;

class Favorites extends \Sinister\Controller
{
    
    public function get($name){
        if ('' == $name) $name = 'undefined';
        $this->name = $name;
    }
    
}