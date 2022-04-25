#!/usr/bin/env php
<?php
require_once __DIR__ . '/vendor/autoload.php';
use Symfony\Component\Console\Application;
use Console\commands\Controller;
use Console\commands\ApplyMigrations;
use Console\commands\CreateMigration;
use Console\commands\CreateModel;
$app = new Application('NMVC CLI', 'v1.0.0');
$app -> add(new Controller());
$app -> add(new ApplyMigrations());
$app -> add(new CreateMigration());
$app -> add(new CreateModel());
$app -> run();