<?php

class User extends \Sinister\Controller
{
    
    public function get($name=''){
        $this->name = $name;
    }
    
    public function getIndex(){
        
    }
    
    public function getNew(){
        die('opa novo');
    }
    
    public function getEdit($user){
        die("editando $user");
    }
    
}