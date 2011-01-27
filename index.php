<?php
include "library/bootstrap.php";
use Sinister\Sinister;
use Sinister\Environment;

$env = new Environment($_SERVER);

$s = Sinister::create()->atachEvents(array(
    'start' => function(){
        // inicializar BD
    }
))->render();