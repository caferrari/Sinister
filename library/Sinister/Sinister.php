<?php

namespace Sinister;

use Sinister\Environment as Environment;

class Sinister 
{
    
    /** Instance of the framework
     *
     * @var type 
     */
    private static $instance;
    
    /**  Framework event container
     *
     * @var Sinister\EventManager;
     */
    private $events;
    
    /**
     *
     * @var Sinister\Environment;
     */
    private $environment;
    
    /**
     * Sinister private constructor
     */
    private function __construct()
    {
        header('Content-Type: text/plain; charset=utf-8');
        $this->events = new EventManager;
        Exception::registerErrorHandler();
    }
    
    /** get the instance of the Sinister framework
     *
     * @return Sinister\Sinister 
     */
    public static function getInstance()
    {
        if (!self::$instance) self::$instance = new self();
        return self::$instance;
    }
    
    /** Define the environment of the framework by dependence injection
     *
     * @param Sinister\Environment $env 
     */
    public function setEnvironment(Environment $env)
    {
        $this->environment = $env;       
    }
    
    /** Execute the framework
     *
     * @return void 
     */
    public function execute()
    {
        $dispatcher = new Dispatcher($this->environment);
        return $dispatcher->dispatch($this->environment);
    }
    
}