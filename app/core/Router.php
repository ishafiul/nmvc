<?php

namespace app\core;

class Router
{
    public array $routes =[];
    public Request $request;


    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }
    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {
        $method = $this->request->getMethod();
        $url = $this->request->getUrl();
        $position = strpos($url,'public')+6;
        $url = substr($url,$position);
        $callback = $this->routes[$method][$url] ?? false;
        if (!$callback) {
            echo 'error';
        }
        else if (is_string($callback)){
             App::$app->view->render($callback);
        }
        elseif (is_array($callback)){
            $controller = new $callback[0];
            $controller->action = $callback[1];
            App::$app->controller = $controller;
            $callback[0] = $controller;
            return call_user_func($callback,$this->request);
        }
        else{
            return call_user_func($callback,$this->request);
        }
        //var_dump($callback);
        //var_dump($this->routes[$method][$url]);
        return 'something wrong';
    }


}