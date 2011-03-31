<?php

namespace User;

class Favorites extends \Sinister\Controller
{
    public function get($name){
       
    }
    
    public function getAll($name) {
        if ('' == $name) $name = 'undefined';
        $this->name = $name;
    }
    
}
