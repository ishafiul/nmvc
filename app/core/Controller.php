<?php

namespace app\core;
use Dotenv\Dotenv;

class Controller
{
    public function view($view,$data=null){
        App::$app->view->render($view,$data);
    }
    public function __construct()
    {
        $dotenv=Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->load();
    }
}