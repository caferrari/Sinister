<?php

namespace Sinister;

class AppContext {

    static $vars = array();
    
    public function execute(Environment $env) 
    {
        $this->execFrontController($env);
        $this->execController($env);
        return $this->render($env);
    }

    public function execFrontController(Environment $env) 
    {
        if (class_exists('\FrontController')) {
            $fc = new FrontController;
        }
    }

    public function execController(Environment $env) 
    {
        
        if (!class_exists($env->controller)){
            throw new Exception\ControllerNotFoundException(sprintf('Controller %s not found', $env->controller));
        }
        
        $controller = new $env->controller();
        $controller->environment = $env;
        
        if (method_exists($controller, $env->method)) {
            call_user_func_array(array($controller, $env->method), $env->pars);
        }else{
            throw new Exception\NotImplementedException(sprintf('Action %s is not defined in the controller %s', $env->method, $env->controller));
        }
    }
    
    public function render(Environment $env)
    {
        $view = new View;
        return $view->render($env, self::$vars);
    }

    public function __set($prop, $val) {
        if (substr($prop, 0, 1) == '_') {
            $method = '_set' . ucfirst(substr($prop, 1));
            if (method_exists($this, $method)) {
                $this->$method($val);
            }
        } else {
            self::$vars[$prop] = $val;
        }
    }
    
    public function __get($par){
        if (isset(self::$vars[$par]))
            return self::$vars[$par];
        return $this->$par;
    }

    private function _setView($v) {
        $this->environment->view = $v;
    }

}