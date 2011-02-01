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
    
    /** requested uri
     *
     * @var String
     */
    public $uri;
    
    /** request parameters
     *
     * @var Array
     */
    public $pars;
    
    /** Constructor of the environment manager
     *
     * @param Array $server 
     */
    public function __construct($server)
    {
        $this->virtualRoot = str_replace('library/bootstrap.php', '', $server['PHP_SELF']);
        $this->root        = str_replace('library/bootstrap.php', '', $server['SCRIPT_FILENAME']);
        $this->uri         = preg_replace('@\?.*$@', '', str_replace($this->virtualRoot, '/', $server['REQUEST_URI']));
        $this->method      = strtolower($server['REQUEST_METHOD']);
        parse_str($server['QUERY_STRING'], $this->pars);
    }
    
}