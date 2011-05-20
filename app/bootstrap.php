<?php

use Sinister\Sinister;
use Sinister\Environment;

$s = new Sinister;
$environment = new Environment($_SERVER, 'development');
echo $s->execute($environment);
