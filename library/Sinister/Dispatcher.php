<?php

namespace Sinister;

class Dispatcher {

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
        return $context->execute($environment);
    }

}
