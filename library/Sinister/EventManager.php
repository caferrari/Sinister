<?php

namespace Sinister;

class EventManager
{
    
    private $events = array();
    
    public function __construct()
    {

    }
    
    /** Attach a new event
     *
     * @param String $event_name
     * @param Closure $event_function 
     */
    public function attach($event_name, $event_function)
    {
        if (!isset($this->events[$event_name])) 
                $this->events[$event_name] = array();
        $this->events[$event_name] = $event_function;
    }
    
    /** Attach a vector with events
     *
     * @param Array $events
     * @return EventManager 
     */
    public function atachEvents($events)
    {
        foreach ($events as $eventName => $eventFunction){
            $this->events->atach($eventName, $eventFunction);
        }
        return $this;
    }
    
}