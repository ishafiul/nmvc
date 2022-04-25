<?php

namespace app\core;
use Dotenv\Dotenv;

abstract class Controller
{
    public array $middlewares = [];
    public string $action = '';
    public function __construct()
    {
        $dotenv=Dotenv::createImmutable(dirname(__DIR__, 2));
        $dotenv->load();
    }
    public function view($view,$data=null){
        App::$app->view->render($view,$data);
    }
    public function middleware(Middleware $middleware){
        $this->middlewares[] =$middleware;
    }
}