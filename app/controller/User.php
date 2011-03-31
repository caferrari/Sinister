<?php

class User extends \Sinister\Controller
{
    
    public function get($name=''){
        $this->name = $name;
    }
    
    public function getAll(){
        
    }
    
    public function getNew(){
        die('opa novo');
    }
    
}