<?php

namespace Sinister;

use Sinister\Environment as Environment;

class Sinister {
    
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
    private function __construct(){
        $this->events = new EventManager;
    }
    
    /** get the instance of the Sinister framework
     *
     * @return Sinister\Sinister 
     */
    public static function getInstance(){
        if (!self::$instance) self::$instance = new self();
        return self::$instance;
    }
    
    /** Define the environment of the framework by dependence injection
     *
     * @param Sinister\Environment $env 
     */
    public function setEnvironment(Environment $env){
        $this->environment = $env;       
    }
    
    /** Render the framework output
     *
     * @return void 
     */
    public function render(){
        ob_start();
        echo "renderizando";
        $contents = ob_get_clean();
        echo $contents;
    }
    
}