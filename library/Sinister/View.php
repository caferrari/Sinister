<?php

namespace Sinister;

class View
{
    
    public function render(Environment $env, $vars)
    {
        $path = $env->root . 'app/view/' . $env->view;
        
        if (!file_exists($path)) 
            throw new Exception\ViewNotFoundException(sprintf('View %s not found', $env->view));
        
        header('Content-Type: text/html; charset=utf-8');
        ob_start();
        extract($vars);
        if (file_exists($path)) include($path);
        $contents = $this->fixLinks($env, ob_get_clean());
        foreach ($vars as $k => $v){
            try {
                $contents = str_replace('{' . $k . '}', $v, $contents);
            } catch (Exception $e) { }
        }
        return $contents;
    }
    
    public function fixLinks(Environment $env, $html)
    {
        return preg_replace('@href="/@', 'href="' . $env->virtualRoot, $html);
    }
    
}