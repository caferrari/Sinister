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
     * Sinister private constructor
     */
    public function __construct()
    {
        header('Content-Type: text/plain; charset=utf-8');
        $this->events = new EventManager;
        Exception::registerErrorHandler();
    }
        
    /** Execute the framework
     *
     * @return void 
     */
    public function execute($environment)
    {
        $dispatcher = new Dispatcher($environment);
        return $dispatcher->dispatch($environment);
    }
    
}