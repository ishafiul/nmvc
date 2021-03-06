<?php

namespace app\core;
use app\core\Exceptions\NotFound;

class Router
{
    public array $routes =[];
    public Request $request;
    public NotFound $exception;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->exception = new NotFound();
    }


    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }
    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function getRouteMap($method): array
    {
        return $this->routes[$method] ?? [];
    }

    public function getCallback()
    {
        $method = $this->request->getMethod();
        $url = $this->request->getUrl();
        /*$position = strpos($url,'public')+6;
        $url = substr($url,$position);*/
        // Trim slashes
        $url = trim($url, '/');

        // Get all routes for current request method
        $routes = $this->getRouteMap($method);

        $routeParams = false;

        // Start iterating registed routes
        foreach ($routes as $route => $callback) {
            // Trim slashes
            $route = trim($route, '/');
            $routeNames = [];

            if (!$route) {
                continue;
            }

            // Find all route names from route and save in $routeNames
            if (preg_match_all('/\{(\w+)(:[^}]+)?}/', $route, $matches)) {
                $routeNames = $matches[1];
            }

            // Convert route name into regex pattern
            $routeRegex = "@^" . preg_replace_callback('/\{\w+(:([^}]+))?}/', fn($m) => isset($m[2]) ? "({$m[2]})" : '(\w+)', $route) . "$@";

            // Test and match current route against $routeRegex
            if (preg_match_all($routeRegex, $url, $valueMatches)) {
                $values = [];
                for ($i = 1; $i < count($valueMatches); $i++) {
                    $values[] = $valueMatches[$i][0];
                }
                $routeParams = array_combine($routeNames, $values);

                $this->request->setRouteParams($routeParams);
                return $callback;
            }
        }

        return $url;
    }


    /**
     * @throws NotFound
     */
    public function resolve()
    {
        $method = $this->request->getMethod();
        $url = $this->request->getUrl();
        $callback = $this->routes[$method][$url] ?? false;
        if (!$callback) {

            $callback = $this->getCallback();
        }
        if (is_string($callback)){

            if (App::$app->view->isViewExist($callback) && (isset($this->routes['get'][$callback]) || isset($this->routes['post'][$callback])) || $this->routes['get']['/'] == $callback){
                App::$app->view->render($callback);
            }
            else{
                throw $this->exception;
            }
        }
        if (is_array($callback)){
            $controller = new $callback[0];
            App::$app->action = $callback[1];
            App::$app->controller = $controller;
            $middlewares = $controller->middlewares;
            foreach ($middlewares as $middleware) {
                $middleware->execute();
            }
            $callback[0] = $controller;
        }
        if (!is_string($callback) && call_user_func($callback,$this->request)){
            return call_user_func($callback,$this->request);
        }
        else{
            return 'something wrong';
        }
    }
}