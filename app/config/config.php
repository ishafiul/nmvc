<?php

use Dotenv\Dotenv;

$dotenv=Dotenv::createImmutable(dirname(dirname(__DIR__)));
$dotenv->load();