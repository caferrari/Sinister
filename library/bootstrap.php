<?php

error_reporting(-1);
ini_set('display_errors', true);

set_include_path('library' . PATH_SEPARATOR . '../app/controller/' . PATH_SEPARATOR . get_include_path());

include 'SplClassLoader.php';

$scl = new SplClassLoader();
$scl->register('./library/');
$scl->register('../app/controller/');

use Sinister\Sinister;
use Sinister\Environment;

$s = Sinister::getInstance();
$s->setEnvironment(new Environment($_SERVER));

echo $s->execute();