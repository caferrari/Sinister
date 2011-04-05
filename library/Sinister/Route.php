<?php

namespace Sinister;

abstract class Route
{
    
    protected static $routes = array();
    
    public function execute($uri, $method){
        return $this->parseUri($this->findRoute($uri), $method);
    }
    
    public function findRoute($uri){
        
        foreach (self::$routes as $r){
        
        }
        
        return $uri;
    }
    
    public function parseUri($uri, $method) 
    {
        $parts = explode('/', trim($uri, '/'));

        if ($parts && in_array($parts[count($parts) - 1], array('new', 'edit'))){
            $method = 'get' . ucfirst(array_pop($parts));
        }
        
        $controllerPath = array();
        $viewPath = array();
        $pars = array();

        $last_is = 'class';
        foreach ($parts as $k => $part) {
            if (0 === $k % 2) {
                $controllerPath[] = $this->camelize($part);
                $viewPath[] = $part;
                $last_is = 'controller';
            } else {
                $pars[] = $part;
                $last_is = 'parameter';
            }
        }
        
        if (in_array($method, array('getNew', 'getEdit'))){
            $last_is = ($method == 'getNew') ? 'controller' : 'parameter';
            $viewPath[] = strtolower(str_replace('get', '', $method));
        }
        
        if ($method == 'get'){
            if ($last_is == 'controller') {
                $method = 'getIndex';
                $viewPath[] = 'index';
            }else{
                $viewPath[] = 'get';
            }
        }
        
        $controller = '\\' . implode($controllerPath, '\\');
        $view       = implode($viewPath, '/');
        
        if ($controller == '\\')    $controller = '\\Index';
        if ($view == '')            $view = 'get';
        
        return array(
            'controller' => $controller,
            'view'       => $view . '.php',
            'pars'       => $pars,
            'method'     => $method,
            'routed'     => false
        );

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