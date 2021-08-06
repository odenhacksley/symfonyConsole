<?php

require_once 'vendor/autoload.php';

use Symfony\Component\Console\Application;
use Commands\SayString;

$application = new Application();
$application->add(new SayString());
$application->run();