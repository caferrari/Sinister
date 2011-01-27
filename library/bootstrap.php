<?php

error_reporting(-1);
ini_set('display_errors', true);

include 'SplClassLoader.php';

$scl = new SplClassLoader();
$scl->register('./library/');

use Sinister\Sinister;
use Sinister\Environment;

$s = Sinister::getInstance();
$s->setEnvironment(new Environment($_SERVER));