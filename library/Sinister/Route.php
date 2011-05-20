<?php

namespace Sinister;

use Sinister\Exception\InvalidUriException;

abstract class Route
{
    
    protected static $routes = array();
    
    public function execute($uri, $method)
    {
        return $this->parseUri($this->findRoute($uri), $method);
    }
    
    public function findRoute($uri)
    {
        
        foreach (self::$routes as $r){
            // match ?
        }
        
        return $uri;
    }
    
    public function parseUri($uri, $method) 
    {
    
    	if (preg_match('@\.([a-z]+$)@', $uri, $mat)){
    		$contentType = $mat[1];
    		$uri = str_replace($mat[0], '', $uri);
    	}else
    		$contentType = 'html';
    
        $parts = explode('/', trim($uri, '/'));

        if ($parts && in_array(end($parts), array('new', 'edit'), true))
            $method = 'get' . ucfirst(array_pop($parts));
        
        $controllerPath = $viewPath = $pars = array();

        foreach ($parts as $k => $part) 
            if (0 === $k % 2)
                $controllerPath[] = $this->camelize($viewPath[] = $part);
            else
                $pars[] = $part;
        
        if (in_array($method, array('getNew', 'getEdit'))){
            $last_is = ($method == 'getNew') ? 'controller' : 'parameter';
            $viewPath[] = strtolower(str_replace('get', '', $method));
        }
        
        if ($method == 'get')
            if (0 === $k % 2) {
                $method = 'getIndex';
                $viewPath[] = 'index';
            }else
                $viewPath[] = 'get';
        
        
        if ('getEdit' == $method && 0 === $k % 2) 
            throw new InvalidUriException('you need to specify the resource to edit');
        
        $controller = '\\' . implode($controllerPath, '\\');
        $view       = implode($viewPath, '/');
        
        if ($controller == '\\')    $controller = '\\Index';
        if ($view == '')            $view = 'get';
        
        return array(
            'controller' => $controller,
            'view'       => $view . '.php',
            'contentType'=> $contentType,
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
