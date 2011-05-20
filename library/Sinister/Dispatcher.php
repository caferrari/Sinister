<?php

namespace Sinister;

class Dispatcher {

	var $headers = array(
		'400' => 'HTTP/1.1 400 Bad Request',
		'403' => 'HTTP/1.1 403 Forbidden',
		'404' => 'HTTP/1.1 404 Not Found',
		'500' => 'HTTP/1.1 500 Internal Server Error',
		'501' => 'HTTP/1.1 500 Internal Server Error'
	);
		

    public function __construct(Environment $env) 
    {
        if ($env->router){
            //$route = new Route\{$env->router}();
        }else
            $route = new Route\Basic();
        
        $parsed = $route->execute($env->uri, $env->method);
        
        foreach ($parsed as $k => $v)
            $env->$k = $v;
    }

    public function dispatch($environment)
    {
        $context = new AppContext;
        try {
        	return $context->execute($environment);
        } catch (Exception $e){
			header($this->headers[$e->httpCode]);
        	if ($environment->environment != 'production')
        		return (string)$e;
        	else
        		if (file_exists('../app/controller/Error.php')){
        		
        			$environment->oldController = $environment->controller;
        			$environment->oldMethod = $environment->method;
        			
        			$environment->controller = '\Error';
        			$environment->method = 'get' . $e->httpCode;
        			try {
        				return $context->execute($environment);
        			} catch (Exception $e) { }
        		}
        		return 'Internal error';
        }
    }

}
