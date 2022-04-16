#!/usr/bin/env php
<?php
require_once __DIR__ . '/vendor/autoload.php';
use Symfony\Component\Console\Application;
use Console\commands\Controller;
$app = new Application('NMVC CLI', 'v1.0.0');
$app -> add(new Controller());
$app -> run();