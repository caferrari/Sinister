<?php

namespace Sinister;

class View
{
    
    public function render(Environment $env, $vars)
    {
        header('Content-Type: text/html; charset=utf-8');
        ob_start();
        extract($vars);
        
        $path = $env->root . 'app/view/' . $env->view . '.php';
        
        include($path);
        return $this->fixLinks($env, ob_get_clean());
    }
    
    public function fixLinks(Environment $env, $html){
        return preg_replace('@href="/@', 'href="' . $env->virtualRoot, $html);
    }
    
}