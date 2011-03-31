<?php

namespace Sinister;

class Dispatcher {

    public function __construct($env) 
    {
        $parsed             = $this->parseUri($env);
        $env->pars          = $parsed->pars;
        $env->controller    = $parsed->controller;
        $env->view          = $parsed->view;
    }

    public function parseUri($env) 
    {
        $uri = trim($env->uri, '/');

        $parts = explode('/', $uri);

        $controllerPath = array();
        $viewPath = array();
        $pars = array();

        $last_is = 'class';
        foreach ($parts as $k => $part) {
            if (0 === $k % 2) {
                $controllerPath[] = $this->camelize($part);
                $viewPath[] = $part;
                $last_is = 'class';
            } else {
                $pars[] = $part;
                $last_is = 'parameter';
            }
        }
        
        if ($pars && $env->method == 'get' && $pars[count($pars)-1] == 'new'){
            $env->method = 'getNew';
            $last_is = 'class';
            $viewPath[] = 'new';
            array_pop($pars);
        }
        
        if ($env->method == 'get'){
            if ($last_is == 'class') {
                $env->method = 'getAll';
                $viewPath[] = 'index';
            }else{
                $viewPath[] = 'get';
            }
        }
        
        $controller = '\\' . implode($controllerPath, '\\');
        $view       = implode($viewPath, '/');
        
        if ($controller == '\\')    $controller = '\\Index';
        if ($view == '')            $view = 'get';
        
        $env->controller    = $controller;
        $env->view          = $view . '.php';
        $env->pars          = $pars;

        return $env;
    }
    
    public function dispatch($environment)
    {
        $context = new AppContext;
        return $context->execute($environment);
    }

    /**
     * Convert sala-de-imprensa to SalaDeImprensa
     * @param $str String
     * @return String
     */
    public function camelize($str='') 
    {
        return str_replace(' ', '', ucwords(str_replace(array('_', '-'), ' ', $str)));
    }

    /**
     * Convert SalaDeImprensa to sala_de_imprensa
     * @param $str String
     * @return String
     */
    public function uncamelize($str='') 
    {
        return preg_replace('@^_+|_+$@', '', strtolower(preg_replace("/([A-Z])/", "_$1", $str)));
    }

}
