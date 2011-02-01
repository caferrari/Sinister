<?php

namespace Sinister;

class Dispatcher {

    public function __construct($env) {
        
        $parsed             = $this->parseUri($env->uri);
        $env->pars          = $parsed->pars;
        $env->controller    = $parsed->controller;
        $env->view          = $parsed->view;
    }

    public function setDefaultRoute($route) {
        
    }

    public function parseUri($uri) {
        $uri = trim($uri, '/');

        $parts = explode('/', $uri);

        $controllerPath = array();
        $viewPath = array();
        $pars = array();

        foreach ($parts as $k => $part) {
            if (0 === $k % 2) {
                $controllerPath[] = $this->camelize($part);
                $viewPath[] = $part;
            } else {
                $pars[] = $part;
            }
        }

        $controller = '\\' . implode($controllerPath, '\\');
        $view       = implode($viewPath, '/');
        
        if ($controller == '\\')    $controller = '\\Index';
        if ($view == '')            $view = 'index';
        
        return (object)array(
            'controller'    => $controller,
            'view'          => $view,
            'pars'          => $pars
        );
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
    public function camelize($str='') {
        return str_replace(' ', '', ucwords(str_replace(array('_', '-'), ' ', $str)));
    }

    /**
     * Convert SalaDeImprensa to sala_de_imprensa
     * @param $str String
     * @return String
     */
    public function uncamelize($str='') {
        return preg_replace('@^_+|_+$@', '', strtolower(preg_replace("/([A-Z])/", "_$1", $str)));
    }

}
