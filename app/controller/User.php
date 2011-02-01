<?php

class User extends \Sinister\Controller
{
    
    public function get($name=''){
        
        if ('' == $name) $this->getAll();
        
        $this->name = $name;
    }
    
    public function getAll(){
        
        $this->_view = 'user_all';
        
    }
    
}