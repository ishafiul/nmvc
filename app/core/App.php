<?php

namespace app\core;

class App
{

    /**
     * @var App
     */
    public static App $app;
    public Router $router;
    public Request $request;
    public $controller = null;
    /**
     * @var View
     */
    public $view;

    public function __construct()
    {
        self::$app = $this;
        $this->request =new Request();
        $this->router = new Router($this->request);
        $this->view =new View();
    }

    public function run()
    {
        $this->router->resolve();
    }
}