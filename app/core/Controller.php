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
        if (isset($data['metadata'])){
            if (isset($data['metadata']['title'])){
                App::$app->view->title = $data['metadata']['title'];
            }
            if (isset($data['metadata']['description'])){
                App::$app->view->description = $data['metadata']['description'];
            }
            if (isset($data['metadata']['keywords'])){
                App::$app->view->keywords = $data['metadata']['keywords'];
            }
            if (isset($data['metadata']['author'])){
                App::$app->view->author = $data['metadata']['author'];
            }

        }
        App::$app->view->render($view,$data);
    }
    public function middleware(Middleware $middleware): void
    {
        $this->middlewares[] =$middleware;
    }
}