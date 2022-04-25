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
    public Controller $controller;
    public string $action = '';
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
        try {
            $this->router->resolve();
        }
        catch (\Exception $e ){
            $this->view->render('_error',[
                "err"=>$e
            ],$e->getCode());
        }
    }
}