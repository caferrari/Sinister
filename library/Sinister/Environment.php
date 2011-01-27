<?php

namespace Sinister;

class Environment
{
    /** framework virtual directory
     *
     * @var String 
     */
    public $virtualRoot;
    
    /** framework root directory
     *
     * @var String
     */
    public $root;
    
    /** Constructor of the environment manager
     *
     * @param Array $server 
     */
    public function __construct($server)
    {
        $this->virtualRoot = str_replace('library/bootstrap.php', '', $server['PHP_SELF']);
        $this->root        = str_replace('library/bootstrap.php', '', $server['SCRIPT_FILENAME']);
    }
    
}